import axios from "axios"

const changeOrderForm = new Event('changeOrderForm')

$('[name=delivery]').on('change', function () {
    let form = $(this).val()

    axios.post('/catalog/order/order_type_form', {form}).then((response) => {
        $('#delivery-container').html(response.data)
        document.dispatchEvent(changeOrderForm)
    })
})

document.addEventListener('changeOrderForm', function () {
    searchNovaPost()
}, false)

function searchNovaPost() {
    if (!$('#sending_city').length) {
        return;
    }

    $('#sending_city').select2({
        theme: 'bootstrap4',
        minLength: 2,
        ajax: {
            type: 'post',
            url: '/api/new_post/search_cities',
            data: (params) => {
                return {
                    search: params.term
                }
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data, function (item) {
                        return {
                            text: item.name_uk,
                            id: item.id
                        }
                    })
                };
            },
            delay: 400
        },
        cache: true,
    })
}


$(document).ready(function () {
    searchNovaPost()
})

$(document).on('change', '#sending_city', function () {
    let city = $(this).val()

    $.post('/api/new_post/get_warehouses', {city}).then(function (response) {
        if (response.data.length) {
            let options = ''
            $.map(response.data, function (item) {
                options += `<option value="${item.id}">${item.name_uk}</option>`
            })

            $('#sending_warehouse').attr('disabled', false).html(options)
        } else {
            let options = '<option>Empty</option>'
            $('#sending_warehouse').attr('disabled', true).html(options)
        }
    })
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
        console.log(response)
        // window.location.href = response.data.redirectLink
    }).catch((response) => {
        button.attr('disabled', false)
        alert('Error')
    })
})