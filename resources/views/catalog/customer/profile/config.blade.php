@extends('catalog.layout')

@section('title', translate('Мій профіль'))

@section('content')

    <main>
        <div class="container margin_30">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="{{ route('index') }}">
                            @translate('Головна')
                        </a>
                    </li>

                    <li>
                        @translate('Мій профіль')
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-center">
                        @translate('Контакти')
                    </h5>

                    <form action="{{ route('catalog.post', ['customer', 'update_contacts']) }}">
                        <div class="form-group">
                            <label>@translate('Імя')</label>
                            <input class="form-control" name="first_name" value="{{ customer()->first_name }}">
                        </div>

                        <div class="form-group">
                            <label>@translate('Прізвище')</label>
                            <input class="form-control" name="last_name" value="{{ customer()->last_name }}">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-primary">
                                @translate('Зберегти')
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h5 class="text-center">
                        @translate('Безпека')
                    </h5>

                    <form action="{{ route('catalog.post', ['customer', 'update_password']) }}" method="POST">
                        <div class="form-group">
                            <label>@translate('Новий пароль')</label>
                            <input class="form-control" name="password" type="password">
                        </div>

                        <div class="form-group">
                            <label>@translate('Повторіть пароль')</label>
                            <input class="form-control" name="password_confirmation" type="password">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-primary">
                                @translate('Зберегти')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


@endsection