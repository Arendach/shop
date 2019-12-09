class CommonClass {
    after = 'close';
    redirectRoute = '/';
    errorDriver = 'sweetalert';
    successDriver = 'sweetalert';

    setAfter(action) {
        if (typeof action != 'undefined')
            this.after = action;

        return this;
    }

    setRedirectRoute(route) {
        if (typeof route != 'undefined')
            this.redirectRoute = route;

        return this;
    }

    setSuccessDriver(driver) {
        if (typeof driver != 'undefined')
            this.successDriver = driver;

        return this;
    }

    setErrorDriver(driver) {
        if (typeof driver != 'undefined')
            this.errorDriver = driver;

        return this;
    }

    errorHandler(answer, driver) {
        this.errorDriver = typeof driver == 'undefined' ? this.errorDriver : 'toastr';
        let title = 'title' in answer.responseJSON ? answer.responseJSON.title : JS.error;
        let message = 'message' in answer.responseJSON ? answer.responseJSON.message : JS.unknonw_error;

        if (this.errorDriver == 'sweetalert') swal(title, message, 'error');
        else toastr.error(message, title);
    }

    successHandler(answer, driver) {
        this.successDriver = typeof driver == 'undefined' ? this.successDriver : 'toastr';

        let afterFunction = function () {
        };

        let title = 'title' in answer ? answer.title : JS.successTitle;
        let text = 'message' in answer ? answer.message : JS.successText;

        let redirectRoute = 'redirectRoute' in answer ? answer.redirectRoute : this.redirectRoute;
        let after = 'action' in answer ? answer.action : this.after;
        if (after == 'redirect') {
            afterFunction = function () {
                window.location.href = redirectRoute;
            }
        } else if (after == 'reload') {
            afterFunction = function () {
                window.location.reload();
            }
        }

        if (this.successDriver == 'sweetalert')
            swal({
                type: 'success',
                title,
                text,
                closeOnConfirm: false
            }, function () {
                afterFunction();

                swal.close();
            });
        else
            toastr.success(text, title);
    }

    disableForm(form) {
        let $form = $(form);
        $form.find('input').attr('disabled', true);
        $form.find('select').attr('disabled', true);
        $form.find('textarea').attr('disabled', true);
        $form.find('button').attr('disabled', true).prepend('<i class="fa fa-spinner fa-pulse fa-fw"></i> ');

        return this;
    }

    enableForm(form) {
        let $form = $(form);
        $form.find('input').attr('disabled', false);
        $form.find('select').attr('disabled', false);
        $form.find('textarea').attr('disabled', false);
        $form.find('button').attr('disabled', false).find('i.fa-spinner').remove();

        return this;
    }

    appendErrors(errors) {
        for (let i in errors)
            $('[name="' + i + '"]')
                .addClass('is-invalid')
                .siblings('.feedback')
                .addClass('invalid-feedback')
                .html(errors[i])
                .show();

        return this;
    }

    removeErrors(form) {
        let $form = $(form);
        $form.find('.form-control').removeClass('is-invalid');
        $form.find('.feedback').removeClass('invalid-feedback').hide();

        return this;
    }

    openModal(html) {
        $('body').append(html);
        $('.modal').modal();

        return this;
    }

    closeModal() {
        $('.poster').css('z-index', '-1').animate({opacity: 0}, 400);
        $('#modal').css('z-index', '1').animate({opacity: 0}, 400);
        setTimeout(function () {
            $('#modal').css('display', 'none');
        }, 400);

        return this;
    }
}

export default CommonClass;