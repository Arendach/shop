<form action="{{ route('catalog.post', ['customer', 'login']) }}" method="post"
      onsubmit="Customer.submitLogin(this); return false;">
    <div class="row no-gutters">
        <div class="col-lg-6 pr-lg-1">
            <a href="#0" class="social_bt facebook">@translate('Вхід через Facebook')</a>
        </div>
        <div class="col-lg-6 pl-lg-1">
            <a href="#0" class="social_bt google">@translate('Вхід через Google')</a>
        </div>
    </div>
    <div class="divider"><span>@translate('Або')</span></div>
    <div class="form-group">
        <input class="form-control" name="login" placeholder="@translate('Номер телефону або Email')">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="@translate('Пароль')">
    </div>
    <div class="clearfix add_bottom_15">
        <div class="checkboxes float-left">
            <label class="container_check">@translate('Запамятати мене')
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="float-right">
            <a id="forgot" href="javascript:void(0);">@translate('Забули пароль?')</a>
        </div>
    </div>
    <div class="text-center">
        <button class="btn_1 full-width">
            @translate('Авторизація')
        </button>
    </div>
    <div id="forgot_pw">
        <div class="form-group">
            <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
        </div>
        <p>A new password will be sent shortly.</p>
        <div class="text-center"><input type="submit" value="Reset Password" class="btn_1">
        </div>
    </div>
</form>