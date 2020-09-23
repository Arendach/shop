<div class="col-lg-4 col-md-6">
    <div class="step first payments">
        <h3>1. @translate('Контактні дані')</h3>

        <h6 class="pb-2">@translate('Контакти')</h6>

        <div class="form-group">
            <label>* @translate('Імя')</label>
            <input required class="form-control" value="{{ customer()->first_name }}" name="first_name">
        </div>

        <div class="form-group">
            <label>* @translate('Прізвище')</label>
            <input required class="form-control" value="{{ customer()->last_name }}" name="last_name">
        </div>

        <div class="form-group">
            <label>@translate('Електронна пошта')</label>
            <input required type="email" class="form-control" value="{{ customer()->email }}" name="email">
        </div>

        <div class="form-group">
            <label>* @translate('Номер телефону')</label>
            <input required class="form-control" value="{{ customer()->phone }}" name="phone" data-mask="phone">
        </div>

        @if(!isAuth())
            <div class="form-group">
                <label>* @translate('Пароль')</label>
                <input required class="form-control" name="password">
            </div>

            <div class="form-group">
                <label>* @translate('Повторіть пароль')</label>
                <input required class="form-control" name="password_confirmation">
            </div>
        @endif
    </div>
</div>