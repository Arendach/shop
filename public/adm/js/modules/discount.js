$(document).ready(function () {
    var files = {
        image_min_uk: '',
        image_min_ru: '',
        image_second_uk: '',
        image_second_ru: '',
        image_max_uk: '',
        image_max_ru: '',
    };

    $('#update_discount,#create_discount').on('change', 'input[type=file]', function () {
        var input = $(this)[0];
        var $this = $(this);

        if (input.files && input.files[0]) {
            files[$this.attr('name')] = input.files[0];
            $('label[for='+$this.attr('name')+']').html(input.files[0].name);
        }
    });

    $(document).on('submit', '#create_discount', function () {
        event.preventDefault();

        Common.disableForm(this);

        var data = new FormData();
        for (var i in files) data.append(i, files[i])

        data.append('name_uk', $('[name=name_uk]').val());
        data.append('name_ru', $('[name=name_ru]').val());
        data.append('start', $('[name=start]').val());
        data.append('finish', $('[name=finish]').val());
        data.append('page', $('[name=page]').val());

        $.ajax({
            type: 'post',
            url: Data.storeRoute,
            processData: false,
            contentType: false,
            data: data,
            success: function (answer) {
                swal({
                    type: 'success',
                    title: Data.storeSuccessTitle,
                    text: answer.message,
                    closeOnConfirm: false
                }, function () {
                    window.location.href = answer.redirectRoute;
                });
            },
            error: function (answer) {
                Common.errorHandler(answer);
                Common.appendErrors(answer.responseJSON.errors);
            }
        });
        Common.enableForm(this);
    });

    $(document).on('submit', '#update_discount', function () {
        event.preventDefault();

        var form = $(this);

        Common.disableForm(form);

        var data = new FormData();
        for (var i in files) data.append(i, files[i])

        data.append('name_uk', $('[name=name_uk]').val());
        data.append('name_ru', $('[name=name_ru]').val());
        data.append('start', $('[name=start]').val());
        data.append('finish', $('[name=finish]').val());
        data.append('page', $('[name=page]').val());
        data.append('published', $('[name=published]').val());
        data.append('_method', 'PATCH');

        $.ajax({
            type: 'post',
            url: Data.updateRoute,
            processData: false,
            contentType: false,
            data: data,
            success: function (answer) {
                swal({
                    type: 'success',
                    title: Data.storeSuccessTitle,
                    text: answer.message,
                });

                Common.removeErrors(form);
            },
            error: function (answer) {
                Common.errorHandler(answer);
                Common.appendErrors(answer.responseJSON.errors);
            }
        });
        Common.enableForm(form);
    });
});