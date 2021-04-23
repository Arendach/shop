@extends('catalog-old.modal')

@section('content')

    <form class="login">
        <div class="form-group">
            <label>@translate('Телефон або електронна пошта')</label>
            <input class="form-control" name="login">
            <div class="feedback text-danger"></div>
        </div>

        <div class="form-group">
            <label>@translate('Пароль')</label>
            <input type="password" class="form-control" name="password">
            <div class="feedback text-danger"></div>
        </div>

        <div class="form-group">
            <label style="margin-bottom: 0">
                <input type="checkbox" name="remember" checked> @translate('Запамятати мене')
            </label>
        </div>

        <div class="form-group" style="margin-bottom: 0">
            <button class="btn btn-outline-primary">@translate('Авторизація')</button>
        </div>
    </form>


    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form.login', function (event) {
                event.preventDefault();

                let $this = $(this);
                let data = {
                    login: $this.find('[name="login"]').val(),
                    password: $this.find('[name="password"]').val(),
                    remember: $this.find('[name="remember"]').is(":checked")
                };

                $this.find('input').attr('disabled', 'disabled');
                $this.find('button').attr('disabled', 'disabled');

                $.ajax({
                    type: 'post',
                    url: '{{ route('catalog.post', ['user', 'login']) }}',
                    data,
                    success() {
                        $this.find('input').removeAttr('disabled');
                        $this.find('button').removeAttr('disabled');

                        // window.location.reload();
                    },
                    error(answer) {
                        toastr.error(answer.responseJSON.message, 'Помилка!');

                        let errors = answer.responseJSON.errors;

                        for (let field in data)
                            if (field in errors)
                                $this.find('[name="' + field + '"]').parent().find('.feedback').html(errors[field]);

                        $this.find('input').removeAttr('disabled');
                        $this.find('button').removeAttr('disabled');
                    }
                });
            });

            $(document).on('keyup', 'form.login input', function () {
                $(this).parent().find('.feedback').html('');
            })
        });
    </script>

@endsection