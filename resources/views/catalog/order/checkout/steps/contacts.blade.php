<h3>@translate('Контакти')</h3>

@if (!is_auth())
    <div class="form-group">
        <button id="btn-reg-user" type="button" class="btn btn-outline-info w-100">@translate('Авторизуватись')</button>

        <div class="help-block" style="font-size: 14px; color: #ccc; padding: 5px 5px 0;">
            <span id="help-new-user">
                * @translate('Якщо ви не зарестровані то реєстрація пройде автоматично')
            </span>
        </div>
    </div>
@endif

<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Ваше імя')</label>
    <input class="form-control form-control-sm" name="name"
           value="{{ is_auth() ? user()->name : Checkout::getField('name') }}">
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Ваш E-Mail')</label>
    <input class="form-control form-control-sm" name="email" type="email"
           value="{{ is_auth() ? user()->email : Checkout::getField('email') }}">
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Номер телефону')</label>
    <input class="form-control form-control-sm" name="phone"
           value="{{ is_auth() ? user()->phone : Checkout::getField('phone') }}">
    <div class="feedback"></div>
</div>

@if (!is_auth())
    <div class="form-group">
        <label> <i class="text-danger">*</i> @translate('Пароль')</label>
        <input class="form-control form-control-sm" name="password" type="password">
        <div class="feedback"></div>
    </div>

    <div class="form-group" id="password_confirm">
        <label> <i class="text-danger">*</i> @translate('Підтвердіть пароль')</label>
        <input class="form-control form-control-sm" name="password_confirmation" type="password">
        <div class="feedback"></div>
    </div>
@endif