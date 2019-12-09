<div class="col-{{ $chunks }} product-card">
    <div class="product" data-id="{{ $item->id }}">
        <div class="product-top">
            <a href="{{ route('product.view', $item->slug) }}" class="product-image">
                <img width="100%" src="{{ $item->small_image }}" alt="{{ $item->name }}">
            </a>
            <div class="product-body">
                <div style="margin-top: 10px">
                    {!! $item->available !!}
                </div>

                <div class="product-stars">
                    {!! $item->stars !!}
                </div>

                <div class="product-name">
                    <a href="{{ route('product.view', $item->slug) }}">
                        {{ $item->name }}
                    </a>
                </div>
            </div>
        </div>

        <div class="product-bottom">
            <div class="price">
                @if(is_null($item->getOriginal('discount')))
                    <span class="new-price">{{ $item->price }}</span>
                @else
                    <span class="new-price">{{ $item->discount }}</span>
                    <span class="old-price">{{ $item->price }}</span>
                @endif
            </div>

            <div class="buy-buttons">
                <div class="btn-group btn-group w-100">
                    <button class="btn {{ Cart::hasProduct($item->id) ? 'btn-primary' : 'btn-outline-primary' }} add_to_cart">
                        <i class="fa fa-shopping-bag"></i> @lang('collection.to_cart')
                    </button>
                    <a href="{{ !is_auth() ? route('login') : '#' }}"
                       class="btn {{ User::hasDesireProduct($item->id) ? 'btn-primary' : 'btn-outline-primary' }} {{ is_auth() ? 'add_to_desire' : '' }}"
                       title="@if(!User::hasDesireProduct($item->id)) @lang('collection.to_favorites') @else @lang('collection.un_favorites') @endif">
                        <i class="fa fa-heart-o"></i>
                    </a>
                </div>
            </div>
        </div>
        @if(is_admin())
            <hr style="margin-bottom: 0">
            <div style="padding: 5px">
                <a target="_blank" href="{{ route('admin.get', ['product', 'product', 'update']) . parameters(['id' => $item->id]) }}">
                    <i class="fa fa-pencil"></i> Редагувати товар
                </a>
            </div>
        @endif

    </div>
</div>