@php /** @var \App\Models\Product $product */ @endphp
@php /** @var \App\Models\Product $relatedProduct */ @endphp
<div class="top_panel">
    <div class="container header_panel">
        <a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
        <label>@translate('Товар доданий до корзини')</label>
    </div>

    <div class="item">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="item_panel">
                        <figure>
                            <img src="{{ $product->small_image }}" data-src="{{ $product->big_image }}" class="lazy"
                                 alt="{{ $product->name }}">
                        </figure>
                        <h4>{{ $product->name }}</h4>
                        <div class="price_panel">
                            <span class="new_price">{{ $product->discounted_price }}</span>
                            @if($product->is_discounted)
                                <span class="percentage">-{{ $product->discount_percent }}%</span>
                                <span class="old_price">{{ $product->old_price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5 btn_panel">
                    <a href="{{ route('cart') }}" class="btn_1 outline">@translate('Переглянути корзину')</a>
                    <a href="{{ urlWithLogin('checkout')  }}" class="btn_1">@translate('Оформити замовлення')</a>
                </div>
            </div>
        </div>
    </div>

    @if($product->related->count())
        <div class="container related">
            <h4>@translate('Можливо ви будете зацікавлені')</h4>
            <div class="row">
                @foreach($product->related->take(3) as $relatedProduct)
                    <div class="col-md-4">
                        <div class="item_panel">
                            <a href="{{ $relatedProduct->url }}">
                                <figure>
                                    <img src="{{ $relatedProduct->small_image }}"
                                         data-src="{{ $relatedProduct->big_image }}"
                                         alt="{{ $relatedProduct->name }}"
                                         class="lazy">
                                </figure>
                            </a>
                            <a href="{{ $relatedProduct->url }}">
                                <h5>{{ $relatedProduct->name }}</h5>
                            </a>
                            <div class="price_panel">
                                <span class="new_price">{{ $relatedProduct->new_price }}</span>
                                @if($relatedProduct->is_discounted)
                                    <span class="percentage">-{{ $relatedProduct->discount_percent }}%</span>
                                    <span class="old_price">{{ $relatedProduct->old_price }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>