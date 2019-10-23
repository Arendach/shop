@inject('checkout', "App\Services\CheckoutService")

<style>
    #form-loader {
        position: absolute;
        top: calc(50% - 32px);
        left: calc(50% - 32px);
        font-size: 64px;
    }
</style>

<h3 style="margin-top: 20px">Доставка</h3>

<div class="form-group">
    @foreach($order_types as $k => $item)
        <label>
            <input {{ ($checkout->delivery != '' ? $checkout->delivery : config('app.main_order_type')) == $k ? 'checked' : '' }} value="{{ $k }}" type="radio"
                   name="delivery">
            {{ $item['name'] }}
        </label>
        <br>
    @endforeach
</div>

<div id="delivery-form" style="transition: 0.3s ease; position: relative">
    {!! $order_types[Checkout::getField('delivery') != '' ? Checkout::getField('delivery') : config('app.main_order_type')]['form'] !!}
</div>