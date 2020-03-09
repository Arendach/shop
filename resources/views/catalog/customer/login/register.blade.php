<form action="{{ route('catalog.post', ['customer', 'register']) }}" method="post"
      onsubmit="Customer.submitRegister(this); return false">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="private box">
        <div class="row no-gutters">
            <div class="col-6 pr-1">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email *">
                    <small class="form-text text-danger" style="display: none"></small>
                </div>
            </div>
            <div class="col-6 pr-1">
                <div class="form-group">
                    <input class="form-control" name="phone" placeholder="@translate('Номер телефону *')">
                    <small class="form-text text-danger" style="display: none"></small>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-6 pr-1">
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="@translate('Пароль *')">
                <small class="form-text text-danger" style="display: none"></small>
            </div>
        </div>
        <div class="col-6 pr-1">

            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="@translate('Повторіть пароль *')">
                <small class="form-text text-danger" style="display: none"></small>

            </div>
        </div>
    </div>

    <hr>

    {{--  <hr>
      <div class="form-group">
          <label class="container_radio" style="display: inline-block; margin-right: 15px;">Private
              <input type="radio" name="client_type" checked value="private">
              <span class="checkmark"></span>
          </label>
          <label class="container_radio" style="display: inline-block;">Company
              <input type="radio" name="client_type" value="company">
              <span class="checkmark"></span>
          </label>
      </div>--}}
    <div class="private box">
        <div class="row no-gutters">
            <div class="col-6 pr-1">
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" placeholder="@translate('Імя')*">
                    <small class="form-text text-danger" style="display: none"></small>
                </div>
            </div>
            <div class="col-6 pl-1">
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" placeholder="@translate('Прізвище')*">
                    <small class="form-text text-danger" style="display: none"></small>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="custom-select-form">
                <select class="wide add_bottom_10" name="locale">
                    <option value="" selected>@translate('Мова *')</option>
                    <option value="uk">@translate('Українська')</option>
                    <option value="ru">@translate('Російська')</option>
                </select>
            </div>
        </div>
    </div>

    <hr>

    <div class="clearfix"></div>

    <div class="form-group">
        <label class="container_check">
            @translate('Я погоджуюсь з ')
            <a href="#0">@translate('Правилами та умовами')</a>
            <input type="checkbox">
            <span class="checkmark"></span>
        </label>
    </div>
    <div class="text-center">
        <button type="submit" class="btn_1 full-width">@translate('Реєстрація')</button>
    </div>
</form>