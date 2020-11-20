$(document).ready(function () {
    $.validator.addMethod('phoneRule', function (value, element) {
        if (/^[\d]{3}-[\d]{3}-[\d]{2}-[\d]{2}$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, translate('Неправильний формат телефону'));

    $('.grid_item').popover({
        placement: 'bottom',
    });

    $('#form-one-click-order').validate({
        rules: {
            name: "required",
            phone: {
                required: true,
                phoneRule: true
            }
        },
        messages: {
            name: translate('Вкажіть імя'),
            phone: {
                required: translate('Вкажіть телефон'),
                phoneRule: translate('Невірний формат')
            }
        },
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("text-danger");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("is-invalid");
        }
    });
});

$('.click-video').on('click', function () {
    $('#video_title').html($(this).attr('data-video-title'));
    $('#iframe-video').attr('src', '//www.youtube.com/embed/' + $(this).attr('data-video-id'));
});

$('.click-one-click-order').on('click', function () {
    $('#product_id').val($(this).attr('data-id'));
});

$('#make-one-click-order').on('click', function () {
    if ($("#form-one-click-order").valid()) {
        $.ajax({
            method: 'POST',
            url: '/simple_order/create',
            data: {
                name: $('#name-label').val(),
                phone: $('#phone-label').val(),
                id: $('#product_id').val(),
            },
            success: function (response) {
                toastr.success(response.message, response.title);
                $('#one-click-order-window').modal('hide');
            }
        })
    }
});