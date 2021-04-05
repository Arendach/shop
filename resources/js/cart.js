import axios from 'axios'



$(document).on('submit', '[data-type="detail_cart_attach"]', function (e) {
    e.preventDefault()
    let $form = $(e.currentTarget)
    let data = $form.serializeArray()
    let dontShowToastr = $(this).data('dont-show-toastr')

    axios.post('/catalog/cart/attach_detail', {data}).then((response) => {
        $('.dropdown-cart-count').html(response.data.cartContProducts)
        $('.dropdown-cart-products').html(response.data.productsListHtml)
        $('.dropdown-cart-sum').html(response.data.cartSumProducts)
        if (!dontShowToastr) {
            toastr.success(response.data.message, response.data.title)
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
    if(parseFloat(quantity) <= 1)
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

$(document).on('a', 'click', '[data-type="cart_detach_product"]', function () {
    let id = $(this).data('id')

    axios.post('/catalog/cart/detach_product', {id}).then((response) => {
        $(this).parents('tr').remove()
        $('.dropdown-cart-count').html(response.data.cartContProducts)
        $('.dropdown-cart-sum').html(response.data.cartSumProducts)
        $('.sum_amount_product').html(response.data.cartSumProducts)
        toastr.success(response.data.message ?? '', response.data.title ?? undefined)
    })
})



$(document).on('click', '[class="inc button_inc"]', function () {
    let id = $(this).data('id')
    const qty = $('#quantity_cart' + id).val()
    axios.post('/catalog/cart/change_amount_up', {id,qty}).then((response) => {
        $('.sum_amount_one_product' + id).html(response.data.cartSumOneProduct)
        $('#all_product_sum').html(response.data.cartSumProduct)
        toastr.success(response.data.message ?? '', response.data.title ?? undefined)
    })
})
$(document).on('click', '[class="dec button_inc"]', function () {
    let id = $(this).data('id')
    const qty = $('#quantity_cart' + id).val()
    axios.post('/catalog/cart/change_amount_up', {id,qty}).then((response) => {
        $('.sum_amount_one_product' + id).html(response.data.cartSumOneProduct)
        $('#all_product_sum').html(response.data.cartSumProduct)
        if (qty != 0)
            toastr.success(response.data.message ?? '', response.data.title ?? undefined)

    })
    if (qty == 0){
        axios.post('/catalog/cart/detach_product', {id}).then((response) => {
            $(this).parents('tr').remove()
            $('.dropdown-cart-count').html(response.data.cartContProducts)
            $('.dropdown-cart-sum').html(response.data.cartSumProducts)
            $('.sum_amount_product').html(response.data.cartSumProducts)
            toastr.success(response.data.message ?? '', response.data.title ?? undefined)
        })
    }
})

$(document).on('input', '[class="qty2"]', function () {
    let id = $(this).data('id')
    const qty = $('#quantity_cart' + id).val()
    axios.post('/catalog/cart/change_amount_up', {id,qty}).then((response) => {
        $('.sum_amount_one_product' + id).html(response.data.cartSumOneProduct)
        $('#all_product_sum').html(response.data.cartSumProduct)
        if (qty != 0)
            toastr.success(response.data.message ?? '', response.data.title ?? undefined)
    })
    if (qty == 0){
        axios.post('/catalog/cart/detach_product', {id}).then((response) => {
            $(this).parents('tr').remove()
            $('.dropdown-cart-count').html(response.data.cartContProducts)
            $('.dropdown-cart-sum').html(response.data.cartSumProducts)
            $('.sum_amount_product').html(response.data.cartSumProducts)
            toastr.success(response.data.message ?? '', response.data.title ?? undefined)
        })
    }


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