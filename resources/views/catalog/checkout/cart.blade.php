<div class="col-lg-4 col-md-6">
    <div class="step last">
        <h3>3. @translate('Товари')</h3>
        <div class="box_general summary">
            <ul>
                @foreach($cartService->getProducts() as $product)
                    <li class="clearfix">
                        <em>{{ $product->pivot->amount }}x {{ $product->name }}</em>
                        <span>{{ number_format($product->new_price * $product->pivot->amount) }}</span>
                    </li>
                @endforeach
            </ul>
{{--            <ul>
                <li class="clearfix">
                    <em><strong>@translate('Вартість товарів')</strong></em>
                    <span>{{ number_format($cartService->getProductsSum()) }}</span>
                </li>
                <li class="clearfix">
                    <em><strong>@translate('Вартість доставки')</strong></em>
                    <span>{{ number_format($cartService->getDeliverySum()) }}</span>
                </li>
            </ul>--}}
            <div class="total clearfix">
                @translate('Сума')
                <span>
                    {{ number_format($cartService->getProductsSum() + $cartService->getDeliverySum()) }}
                </span>
            </div>
            <a href="javascript:void(0)" onclick="$(this).parents('form').submit()" id="sendCheckoutForm" class="btn_1 full-width">
                @translate('Підтвердити')
            </a>
        </div>
    </div>
</div>