<div class="col-lg-4 col-md-6">
    <div class="step middle payments">
        <h3>2. @translate('Доставка')</h3>

        <h6 class="pb-2">@translate('Спосіб отримання')</h6>

        <ul>
            @foreach(asset_data('order_types') as $key => $orderType)
                <li>
                    <label class="container_radio">
                        {{ $orderType['name'] }}
                        <a href="#0" class="info" data-toggle="modal"
                           data-target="#payments_method"></a>
                        <input type="radio" name="delivery"
                               @checked($loop->iteration == 1) value="{{ $key }}">
                        <span class="checkmark"></span>
                    </label>
                </li>
            @endforeach
        </ul>

        <div id="delivery-container">
            @foreach(asset_data('order_types') as $key => $orderType)
                @break($loop->iteration > 1)
                <div class="delivery-form" id="delivery-{{ $key }}"
                     style="display: {{ $loop->iteration == 1 ? 'block' : 'none' }}">
                    {!! $orderType['form'] !!}
                </div>
            @endforeach
        </div>
    </div>
</div>