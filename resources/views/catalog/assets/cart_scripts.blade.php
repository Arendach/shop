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

                $this
                    .addClass('btn-primary')
                    .removeClass('btn-outline-primary');
            },
            error: function (answer) {
                toastr.error(answer.responseJSON.message, answer.responseJSON.title);
                $this.attr('disabled', false);
            }
        });
    });

    $(document).on('click', '.add_to_desire', function (event) {
        event.preventDefault();

        let $this = $(this);

        let id = $this.parents('.product').data('id');

        $this.attr('disabled', true);

        $.ajax({
            type: 'post',
            url: '{{ route('catalog.post', ['desire', 'add']) }}',
            data: {
                product_id: id
            },
            success: function (answer) {
                toastr.success(answer.message, answer.title);
                $this.attr('disabled', false);

                $this.attr('title', answer.button_title);

                $this
                    .toggleClass('btn-primary')
                    .toggleClass('btn-outline-primary');
            },
            error: function (answer) {
                toastr.error(answer.responseJSON.message, answer.responseJSON.title);
                $this.attr('disabled', false);
            }
        });
    });

</script>