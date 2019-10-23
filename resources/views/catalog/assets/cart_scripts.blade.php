<script>

    $(document).on('click', '.add_to_cart', function () {
        let $this = $(this);


        let id = $this.parents('.product').data('id');

        $this.attr('disabled', true);

        $.ajax({
            type: 'post',
            url: '{{ route('catalog.post', ['cart', 'add']) }}',
            data: {
                id: id
            },
            success: function (answer) {
                $('#cart_products_count').html(answer.cart_products_count);
                toastr.success(answer.message, answer.title);
                $this.attr('disabled', false);
            },
            error: function (answer) {
                toastr.error(answer.responseJSON.message, answer.responseJSON.title);
                $this.attr('disabled', false);
            }
        });
    });

</script>