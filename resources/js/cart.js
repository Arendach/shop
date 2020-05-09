import axios from 'axios'

window.Cart = {
    async attach(id, selector) {
        selector.disabled = true

        await axios.post('/catalog/cart/attach', {id}).then((response) => {
            $('#cart-content').html(response.data.cartContent)
            $('.dropdown-cart-products').html(response.data.productListHtml)
            toastr.success(response.data.message ?? '', response.data.title ?? undefined)
            selector.disabled = false

            let hasProducts = $('.has-products')
            let notProducts = $('.not-products')

            if (response.data.productsListHtml.length) {
                console.log('test')

                hasProducts.show()
                notProducts.hide()
            } else {
                hasProducts.hide()
                notProducts.show()
            }
        })
    },

    async detach(id, selector) {
        if (selector.disabled) {
            return
        }

        selector.disabled = true

        await axios.post('/catalog/cart/detach', {id}).then(response => {
            $(selector).parents('li').remove()
            toastr.success(response.data.message ?? '', response.data.title ?? undefined)
            selector.disabled = false
            $('.dropdown-cart-products').html(response.data.productListHtml)
        })
    },

    async switchDesire(product_id, selector) {
        if (selector.disabled) {
            return
        }

        selector.disabled = true

        await axios.post('catalog/desire/switch', {product_id}).then(response => {
            selector.disabled = false
            toastr.success(response.data.message, response.data.title)
        })
    }
}

// init add to cart button
$(document).on('click', '[data-type="cart_attach"]', function () {
    let id = $(this).data('id')
    let dontShowToastr = $(this).data('dont-show-toastr')
    let quantity = $('#quantity').length ? $('#quantity').val() : 1

    axios.post('/catalog/cart/attach', {id, quantity}).then((response) => {
        $('.dropdown-cart-count').html(response.data.cartContProducts)
        $('.dropdown-cart-products').html(response.data.productsListHtml)
        $('.dropdown-cart-sum').html(response.data.cartSumProducts)
        if (!dontShowToastr) {
            toastr.success(response.data.message ?? '', response.data.title ?? undefined)
        }

        let hasProducts = $('.has-products')
        let notProducts = $('.not-products')

        if (response.data.productsListHtml.length) {
            hasProducts.show()
            notProducts.hide()
        } else {
            hasProducts.hide()
            notProducts.show()
        }
    })
})

$(document).on('click', '[data-type="cart_detach"]', function () {
    let id = $(this).data('id')

    axios.post('/catalog/cart/detach', {id}).then((response) => {
        $('.dropdown-cart-count').html(response.data.cartContProducts)
        $('.dropdown-cart-products').html(response.data.productsListHtml)
        $('.dropdown-cart-sum').html(response.data.cartSumProducts)
        toastr.success(response.data.message ?? '', response.data.title ?? undefined)

        let hasProducts = $('.has-products')
        let notProducts = $('.not-products')

        if (response.data.productsListHtml.length) {
            hasProducts.show()
            notProducts.hide()
        } else {
            hasProducts.hide()
            notProducts.show()
        }
    })
})

$(document).on('click', '[data-type="cart_page_detach"]', function () {
    let id = $(this).data('id')

    axios.post('/catalog/cart/detach', {id}).then((response) => {
        $(this).parents('tr').remove()
        $('.dropdown-cart-count').html(response.data.cartContProducts)
        $('.dropdown-cart-sum').html(response.data.cartSumProducts)
        toastr.success(response.data.message ?? '', response.data.title ?? undefined)
    })
})

$(document).on('input', '[data-type="cart_change_amount"]', function () {
    alert(2)
})

$('form#checkout').on('submit', function (event) {
    event.preventDefault()
    let button = $(this).find('#sendCheckoutForm')

    if (button.attr('disabled')) {
        return
    }

    if (!this.checkValidity()) {
        return alert('Поля не вірно заповнені');
    }

    button.attr('disabled', true)

    let data = new FormData(this)

    axios.post('/checkout', data).then((response) => {
        window.location.href = response.data.redirectLink
    }).catch((response) => {
        button.attr('disabled', false)
        alert('Error')
    })
})