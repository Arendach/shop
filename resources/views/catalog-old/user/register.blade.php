@extends('catalog-old.layout')

@section('style')

    <style>
        form.register {
            padding: 0 25%;
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <form class="register">
            <div class="form-group">
                <h2>@translate('Реєстрація')</h2>
            </div>

            <div class="form-group">
                <label> <i class="text-danger">*</i> @translate('Прізвище та імя')</label>
                <input class="form-control" name="name" required>
                <div class="feedback text-danger"></div>
            </div>

            <div class="form-group">
                <label> <i class="text-danger">*</i> @translate('Телефон')</label>
                <input class="form-control" name="phone" required id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}">
                <div class="feedback text-danger"></div>
            </div>
            <div class="form-group">
                <label> <i class="text-danger">*</i> @translate('Email')</label>
                <input type="email" class="form-control" name="email" required>
                <div class="feedback text-danger"></div>
            </div>

            <div class="form-group">
                <label> <i class="text-danger">*</i> @translate('Пароль')</label>
                <input type="password" class="form-control" name="password" required>
                <div class="feedback text-danger"></div>
            </div>

            <div class="form-group">
                <label> <i class="text-danger">*</i> @translate('Повторний пароль')</label>
                <input type="password" class="form-control" name="password_confirmation" required>
                <div class="feedback text-danger"></div>
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">@translate('Реєстрація')</button>
            </div>

            @translate('Вже зареєстровані? Тоді ')<a href="{{ route('login') }}">@translate('авторизуйтесь тут')</a>!
        </form>
    </div>

@endsection


@section('script')

    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form.register', function (event) {
                event.preventDefault();

                let $this = $(this);
                let data = $this.serializeJSON();

                $this.find('input').attr('disabled', 'disabled');
                $this.find('button').attr('disabled', 'disabled');

                $.ajax({
                    type: 'post',
                    url: '{{ route('catalog.post', ['user', 'register']) }}',
                    data,
                    success() {
                        $this.find('input').removeAttr('disabled');
                        $this.find('button').removeAttr('disabled');

                        window.location.href = '{{ route('index') }}';
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

            $(document).on('keyup', 'form.register input', function () {
                $(this).parent().find('.feedback').html('');
            });

            $('#phone').inputmask('999-999-99-99');
        });
    </script>

@endsection
