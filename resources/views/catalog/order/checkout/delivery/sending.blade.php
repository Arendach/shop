<div class="form-group">
    <label> <i class="text-danger">*</i> Місто</label>
    <input class="form-control form-control-sm" name="sending_city" value="{{ Checkout::getField('sending_city') }}">
    <input type="hidden" name="sending_city_key" value="{{ Checkout::getField('sending_city_key') }}">
    <div id="city-list"></div>
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label> <i class="text-danger">*</i> Відділення</label>
    <select class="form-control form-control-sm" name="sending_warehouse" {{ !Checkout::issetWarehouses() ? 'disabled' : '' }}>
        {!! Checkout::getWarehouses() !!}
    </select>
    <div class="feedback"></div>
</div>

<script>
    $(document).on('keyup', '[name="sending_city"]', function () {
        let city = $(this).val();

        $('[name="sending_city_key"]').val('');
        $('[name="sending_warehouse"]').html('<option value="">-</option>');

        $.ajax({
            type: 'post',
            url: '{{ route('catalog.post', ['order', 'checkout_input']) }}',
            data: {
                fields: {
                    sending_city_key: '',
                    sending_warehouse: '',
                    sending_city: ''
                }
            }
        });

        if (city.length < 1) {
            $('#city-list').html('');
            return;
        }

        $.ajax({
            type: 'post',
            url: '{{ route('catalog.post', ['order', 'new_post_city_search']) }}',
            data: {city: city},
            success: function (answer) {
                $('#city-list').html(answer.content);
            }
        })
    });

    $(document).on('click', '.city-item', function () {
        let $this = $(this);

        $('[name="sending_city"]').val($this.data('name'));
        $('[name="sending_city_key"]').val($this.data('key'));
        $('#city-list').html('');


        $.ajax({
            type: 'post',
            url: '{{ route('catalog.post', ['order', 'new_post_warehouse_search']) }}',
            data: {
                sending_city: $this.text().trim(),
                sending_city_key: $this.data('key')
            },
            success: function (answer) {
                $('[name="sending_warehouse"]')
                    .attr('disabled', false)
                    .html(answer.content);
            },
            error: function (answer) {
                Common.errorHandler(answer);
            }
        })
    });
</script>