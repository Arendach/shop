@php /** @var \App\Models\Product $product */ @endphp

<div class="grid_item">
    <figure>
        @if($product->is_discounted)
            <span class="ribbon off">-{{ $product->discount_percent }}%</span>
        @elseif($product->is_new)
            <span class="ribbon new">@translate('Новинка')</span>
        @elseif($product->is_recommended)
            <span class="ribbon hot">@translate('Рекомендовано')</span>
        @endif
        <a href="{{ route('product.view', $product->slug) }}">
            <img class="img-fluid lazy"
                 src="{{ $product->big_image }}"
                 data-src="{{ $product->big_image }}"
                 alt="{{ $product->name }}"
            >
        </a>
        @if($product->is_discounted)
            <div data-countdown="{{ date('Y/m/d', time() + 3600 * 24) }}"
                 class="countdown"></div>
        @endif
    </figure>
    <div class="rating">
        {!! $product->stars !!}
    </div>
    <a href="{{ route('product.view', $product->slug) }}">
        <h3>{{ $product->name }}</h3>
    </a>
    <div class="price_box">
        <span class="new_price">{{ $product->new_price }}</span>
        @if($product->is_discounted)
            <span class="old_price">{{ $product->old_price }}</span>
        @endif
    </div>
    <ul>
        <li>
            @if(isAuth())
                <a href="javascript:void(0)"
                   onclick="Cart.switchDesire('{{ $product->id }}', this)"
                   @tooltip(translate('Додати в список бажаних'), 'left')
                   class="tooltip-1 {{ customer()->hasDesire($product->id) ? 'desire-attached' : '' }}"
                >
                    <i class="ti-heart"></i>
                    <span>@translate('Додати в список бажаних')</span>
                </a>
            @else
                <a href="{{ route('login') }}" @tooltip(translate('Додати в список бажаних'), 'left') class="tooltip-1">
                    <i class="ti-heart"></i>
                    <span>@translate('Додати в список бажаних')</span>
                </a>
            @endif
        </li>
        {{-- допрацювати порівняння товарів --}}
        @if(false)
            <li>
                <a href="#0" class="tooltip-1" @tooltip(translate('Додати до порівняння'), 'left')>
                    <i class="ti-control-shuffle"></i>
                    <span>@translate('Додати до порівняння')</span>
                </a>
            </li>
        @endif
        <li>
            <a href="javascript:void(0)"
               class="tooltip-1"
               @tooltip(translate('Додати в корзину'), 'left')
               data-type="cart_attach"
               data-id="{{ $product->id }}"
            >
                <i class="ti-shopping-cart"></i>
                <span>@translate('Додати в корзину')</span>
            </a>
        </li>
    </ul>
</div>