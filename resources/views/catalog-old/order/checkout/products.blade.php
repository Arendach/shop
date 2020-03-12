<h3>@translate('Корзина')</h3>

<table>
    @foreach($cart->products as $item)
        <tr class="checkout-product">
            <td>
                <a class="checkout-product-image" target="_blank"
                   href="{{ route('product.view', $item->product->slug) }}"
                   style="background-image: url('{{ $item->product->small_image }}')">
                </a>
            </td>

            <td>
                <a target="_blank" href="{{ route('product.view', $item->product->slug) }}">
                    {{ $item->product->name }}
                </a>
            </td>

            <td class="right">
                    <span class="text-danger">
                        @if (is_null($item->product->getOriginal('discount')))
                            {{ number_format($item->product->getOriginal('price'), 2) }} грн
                        @else
                            <s style="font-size: 14px;color: #ccc">{{ number_format($item->product->getOriginal('price'), 2) }} грн</s>
                            <br>
                            <b>{{ number_format($item->product->getOriginal('discount'), 2) }} грн</b>
                        @endif
                    </span>
            </td>
        </tr>
    @endforeach
</table>

<hr>

<table style="width: 100%">
    <tr>
        <td style="color: #e31837;"><b>@translate('Сума'):</b></td>
        <td class="right" style="color: #e31837;">
            {{ number_format(\Cart::getProductsSum(), 2) }} грн
        </td>
    </tr>
</table>
