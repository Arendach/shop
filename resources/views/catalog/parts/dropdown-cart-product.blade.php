<li>
    <a href="{{ $cart->product->url ?? $cart->url }}">
        <figure>
            <img src="{{ $cart->product->small_image ?? $cart->small_image }}" data-src="{{ $cart->product->big_image ?? $cart->big_image }}"
                 alt="{{ $cart->product->name ?? $cart->name }}" width="50" height="50" class="lazy">
        </figure>
        <strong><span>{{ $cart->amount ?? $cart->pivot->amount }}x {{ $cart->product->name ?? $cart->name }}</span>{{ $cart->product->new_price ?? $cart->new_price }}</strong>
    </a>
    <a href="javascript:void(0)" class="action" data-id="{{ $cart->id }}" data-type="cart_detach">
        <i class="ti-trash"></i>
    </a>
</li>