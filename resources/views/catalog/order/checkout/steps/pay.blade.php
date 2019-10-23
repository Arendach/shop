<h3 style="margin-top: 20px">Оплата</h3>

<div class="form-group">
    <label><i class="text-danger">*</i> Виберіть зручний варіант оплати</label>
    <select class="form-control" name="pay">
        @foreach(asset_data('pay_methods') as $key => $item)
            <option {{ Checkout::getField('pay') == $key ? 'selected' : '' }} value="{{ $key }}">
                {{ $item['name'] }}
            </option>
        @endforeach
    </select>
</div>

<script>
    $(document).on('submit', '#checkout-pay', function (event) {
        event.preventDefault();
        let $this = $(this);

        let data = $this.serializeJSON();

        $this.find('button').prepend('<i class="fa fa-spinner fa-pulse fa-fw"></i> ');
        $this.find('input, button').attr('disabled', true);

        $.ajax({
            type: 'post',
            url: '{{ route('catalog.post', ['order', 'checkout_delivery']) }}',
            data: data,
            success: function (answer) {
                $this.find('input, button').attr('disabled', false);
                $this.find('button').find('i.fa').remove();

                $this.fadeOut();
                console.log(answer);
                if ('content' in answer) $('.checkout-delivery-info').html(answer.content);

                $('.checkout-delivery-button').fadeIn();

                $('.pay').show();
            },
            error: function (answer) {
                $this.find('input, button').attr('disabled', false);
                $this.find('button').find('i.fa').remove();

                answer = answer.responseJSON;

                let title = 'title' in answer ? answer.title : '@lang('common.error')';
                let message = 'message' in answer ? answer.message : '@lang('common.unknown_error')';

                toastr.error(message, title);

                if ('errors' in answer)
                    for (let field in answer.errors)
                        $('[name="' + field + '"]')
                            .parent()
                            .find('.feedback')
                            .addClass('is-invalid')
                            .html(answer.errors[field]);
            }
        });
    });
</script>