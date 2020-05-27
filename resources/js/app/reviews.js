$(document).ready(function(){
    $('#review-form').validate({
        rules: {
            title: "required",
            comment: "required"
        },
        messages: {
            title: translate('Обовязково заповніть це поле'),
            comment: translate('Коментар обовязковий     ')
        },
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "text-danger" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "has-success" ).removeClass( "is-invalid" );
        }
    });
});

$('.btn_1').on('click', function(){
    if ($("#review-form").valid()) {
        $.ajax({
            method: 'POST',
            url: '/product/create-review',
            data: {
                'product_id': $('#product_id').val(),
                'rating': $('.rating-input').val(),
                'title': $('#title').val(),
                'comment': $('#comment').val(),
            },
            success: function(data) {
                toastr.success('Виконано!', data.message);
            }
        });
    }
});