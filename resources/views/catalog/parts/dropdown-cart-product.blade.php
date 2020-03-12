<li>
    <a href="{{ $product->url }}">
        <figure>
            <img src="{{ $product->small_image }}" data-src="{{ $product->big_image }}"
                 alt="{{ $product->name }}" width="50" height="50" class="lazy">
        </figure>
        <strong><span>{{ $product->pivot->amount }}x {{ $product->name }}</span>{{ $product->new_price }}</strong>
    </a>
    <a href="javascript:void(0)" class="action" data-id="{{ $product->id }}" data-type="cart_detach">
        <i class="ti-trash"></i>
    </a>
</li>