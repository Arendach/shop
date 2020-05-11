<div class="col-lg-4 col-md-6">
    <div class="step first payments">
        <h3>1. @translate('Контакти та оплата')</h3>

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
            <label>* @translate('Електронна пошта')</label>
            <input required type="email" class="form-control" placeholder="Email" value="{{ customer()->email }}" name="email">
        </div>

        <div class="form-group">
            <label>* @translate('Номер телефону')</label>
            <input required class="form-control" value="{{ customer()->phone }}" name="phone">
        </div>

        <h6 class="pb-2">@translate('Оплата')</h6>

        <ul>
            @foreach(asset_data('pay_methods') as $key => $payMethod)
                <li>
                    <label class="container_radio">
                        {{ $payMethod['name'] }}
                        {{--<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>--}}
                        <input type="radio" value="{{ $key }}" name="pay_method" @checked($loop->iteration == 1)>
                        <span class="checkmark"></span>
                    </label>
                </li>
            @endforeach
        </ul>
        <div class="payment_info d-none d-sm-block">
            <figure><img src="{{ asset('catalog/img/cards_all.svg') }}"></figure>
           {{-- <p>
                --}}{{-- Тут вивести інформацію по способах оплати --}}{{--
            </p>--}}
        </div>
    </div>
</div>