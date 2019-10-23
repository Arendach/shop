let Common = {
    errorHandler(answer) {
        let title = typeof answer.responseJSON.title != 'undefined' ? answer.responseJSON.title : 'Помилка!';
        let text = typeof answer.responseJSON.message != 'undefined' ? answer.responseJSON.message : 'Невідома помилка';

        swal({
            type: 'error',
            title,
            text
        });
    }
};

$(document).ready(function () {
    toastr.options.closeButton = true;
    toastr.options.newestOnTop = true;
    toastr.options.timeOut = 10 * 1000;
    toastr.options.extendedTimeOut = 5 * 1000;
    toastr.options.progressBar = true;

    $('[data-toggle="tooltip"]').tooltip();


});

$(document).on('hidden.bs.modal', '#modal', function () {
    $('#modal').remove();
});