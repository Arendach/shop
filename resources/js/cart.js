import axios from 'axios'

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

$(document).on('click', '[class="inc button_inc"]', function () {
    let quantity = $('#quantity').length ? $('#quantity').val() : 1
    $('#quantity').val(parseFloat(quantity)+1)
})

$(document).on('click', '[class="dec button_inc"]', function () {
    let quantity = $('#quantity').length ? $('#quantity').val() : 1
    if(parseFloat(quantity) < 1)
        $('#quantity').val(1)
    else
        $('#quantity').val(parseFloat(quantity)-1)
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

$(document).on('click', '[data-type="switchDesire"]', function (event) {
    event.preventDefault()

    let id = $(this).data('id')
    let button = $(this)

    axios.post('/catalog/desire/switch', {id}).then(function (response) {
        button.toggleClass('desire-attached')
    }).catch(function (response) {
        console.error(response)
    })
})