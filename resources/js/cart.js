window.Cart = {
    attach(id, selector) {
        selector.disabled = true

        $.ajax({
            type: 'post',
            url: '/catalog/cart/attach',
            data: {id},
            success(answer) {
                $('#cart_products_count').html(answer.cart_products_count)
                toastr.success(answer.message, answer.title)
                selector.disabled = false
            },
            error(answer) {
                toastr.error(answer.responseJSON.message ?? 'dajlsjl', answer.responseJSON.title ?? 'saksp');
                $this.attr('disabled', false);
            }
        });
    },

    async detach(id, selector) {
        selector.disabled = true

        let response = await fetch('/catalog/cart/detach', {
            method: 'post',
            headers: {"Content-Type": 'application/json'},
            body: JSON.stringify({id: id}),
        })

        if (response.ok) {
            toastr.success(response.json().message)
            selector.disabled = false
        } else {
            toastr.error(response.json().message ?? 'Error')
            selector.disabled = false
        }
    }
}