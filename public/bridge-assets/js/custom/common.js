import CommonClass from './classes/common.class.js';

const Common = new CommonClass();

toastr.options.closeButton = true;
toastr.options.newestOnTop = true;
toastr.options.timeOut = 10 * 1000;
toastr.options.extendedTimeOut = 5 * 1000;
toastr.options.progressBar = true;

$(document).on('keyup', '.form-control', function () {
    $(this)
        .removeClass('is-invalid')
        .parent()
        .find('.feedback')
        .removeClass('invalid-feedback')
        .hide();
});

$(document).on('submit', '[data-type="ajax"]', function (event) {
    event.preventDefault();
    let $form = $(this);

    let data = $form.serializeJSON();
    data = Elements.customFormSerializePush(data, this);

    Common.disableForm($form);
    Common.setAfter($form.data('after'));
    Common.setRedirectRoute($form.data('redirect-route'));
    Common.removeErrors($form);
    Common.setSuccessDriver(typeof $form.data('success-driver') != 'undefined' ? $form.data('success-driver') : 'toastr');
    Common.setErrorDriver(typeof $form.data('error-driver') != 'undefined' ? $form.data('error-driver') : 'toastr');

    $.ajax({
        type: 'post',
        url: $form.data('url'),
        data,
        success(answer) {
            Common.successHandler(answer);
            Common.enableForm($form);
        },
        error(answer) {
            Common.errorHandler(answer);
            Common.appendErrors(answer.responseJSON.errors);
            Common.enableForm($form);
        }
    })
});

$(document).on('click', '[data-type="delete"]', function () {
    let $this = $(this);
    let data = $this.data('post') != undefined ? $this.data('post') : '';

    data += '&_method=DELETE';

    if ($this.data('id') != undefined)
        data += '&id=' + $this.data('id');

    swal({
        type: 'warning',
        text: JS.deleteConfirmText,
        title: JS.deleteConfirmTitle,
        closeOnConfirm: false,
        showCancelButton: true,
        cancelButtonText: JS.cancel
    }, function () {
        $.ajax({
            type: 'post',
            url: $this.data('url'),
            data: data,
            success() {
                swal({
                    type: 'success',
                    text: JS.deleteSuccessText,
                    title: JS.deleteSuccessTitle,
                    closeOnConfirm: false
                }, function () {
                    swal.close();

                    if ($this.data('after') == 'remove') {
                        let $tr = $this.parents('tr').fadeOut(500);
                        setTimeout(function () {
                            $tr.remove();
                        }, 500);
                    } else window.location.reload();
                })
            },
            error(answer) {
                Common.errorHandler(answer);
            }
        });
    });
});

$(document).on('click', '[data-type="get_form"]', function (event) {
    event.preventDefault();
    let $this = $(this);
    let url = $this.data('url');
    let post = $this.data('post');
    let method = $this.data('method');

    method = typeof method == "undefined" ? 'post' : method;

    $this.attr('disabled', true);

    $.ajax({
        type: method,
        url: url,
        data: post,
        success(answer) {
            Common.openModal(answer);
            $this.removeAttr('disabled');
        },
        error(answer) {
            Common.errorHandler(answer);
            $this.removeAttr('disabled');
        }
    });
});

$(document).on('click', '[data-type="ajax_request"]', function (event) {
    event.preventDefault();

    let $this = $(this);
    let url = $this.data('url');
    let data = $this.data('post');
    let type = $this.data('method');

    type = typeof type == "undefined" ? 'post' : type;

    $this.attr('disabled', 'disabled');

    $.ajax({
        type,
        url,
        data,
        success(answer) {
            Common.successHandler(answer);
            $this.removeAttr('disabled');
        },
        error(answer) {
            Common.errorHandler(answer);
            $this.removeAttr('disabled');
        }
    });
});

$(document).on('hide.bs.modal', '.modal', function () {
    $(this).remove();
});

$(document).on('click', '#modal_close', Common.closeModal);

$(document).on('click', '.poster', Common.closeModal);

$(document).keydown(function (eventObject) {
    if (eventObject.which == 27) Common.closeModal();
});

$('[data-toggle="tooltip"]').tooltip();

$(document).on('shown.bs.tab','.nav-pills a', function (e) {
    window.location.hash = e.target.hash;
});

if (document.location.toString().match('#')) {
    $('.nav-pills a[href="#' + document.location.toString().split('#')[1] + '"]').tab('show');
}