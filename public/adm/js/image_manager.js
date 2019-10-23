$(document).ready(function () {
    $(document).on('click', '[data-type=image_manager]', function () {
        $.$.ajax({
            type: 'post',
            url: url('/'),
            data: {
                action: ''
            },
            success: function (answer) {
                
            },
            error: function (answer) {
                errorHandler(answer);
            }
        });
    });
});