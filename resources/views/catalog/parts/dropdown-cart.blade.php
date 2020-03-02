<div class="dropdown dropdown-cart">
    <a href="{{ route('cart') }}" class="cart_bt"><strong>{{ Cart::countProducts() }}</strong></a>
    <div class="dropdown-menu">
        @if(Cart::hasProducts())
            <ul>
                @foreach(Cart::getProducts() as $product)
                    <li>
                        <a href="{{ $product->url }}">
                            <figure>
                                <img src="{{ $product->small_image }}" data-src="{{ $product->big_image }}"
                                     alt="{{ $product->name }}" width="50" height="50" class="lazy">
                            </figure>
                            <strong><span>1x {{ $product->name }}</span>{{ $product->new_price }}</strong>
                        </a>
                        <a href="javascript:void(0)" class="action" onclick="Cart.detach('{{ $product->id }}', this)">
                            <i class="ti-trash"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="total_drop">
                <div class="clearfix">
                    <strong>@translate('Сума')</strong>
                    <span>{{ Cart::getProductsSum() }}</span>
                </div>
                <a href="{{ route('cart') }}" class="btn_1 outline">@translate('Переглянути корзину')</a>
                <a href="checkout.html" class="btn_1">@translate('Оформити замовлення')</a>
            </div>

        @else
            <div class="">
                @translate('В корзині немає товарів')
            </div>
        @endif
    </div>
</div>