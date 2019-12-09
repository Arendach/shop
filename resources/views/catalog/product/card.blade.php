<div class="products">
    @forelse($products->chunk($col) as $chunk)
        <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
            @foreach($chunk as $item)
                <div class="col-3">
                    <div class="product">
                        <div class="product-top">
                            <a href="{{ route('product.view', $item->product->slug) }}" class="product-image">
                                <img width="100%" src="{{ $item->product->small }}"
                                     alt="{{ $item->product->name }}">
                            </a>
                            <div class="product-body">

                                <div style="margin-top: 10px">
                                    {!! $item->product->available !!}</div>

                                <div class="product-stars">
                                    {!! $item->product->stars !!}
                                </div>

                                <div class="product-name">
                                    <a href="{{ route('product.view', $item->product->slug) }}">
                                        {{ $item->product->name }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="product-bottom">
                            <div class="price">
                                @if(is_null($item->product->discount))
                                    <span class="new-price">{{ $item->product->price }}</span>
                                @else
                                    <span class="new-price">{{ $item->product->discount }}</span>
                                    <span class="old-price">{{ $item->product->price }}</span>
                                @endif
                            </div>

                            <div class="buy-buttons">
                                <div class="btn-group btn-group">
                                    <button class="btn btn-outline-primary">
                                        <i class="fa fa-shopping-bag"></i> @lang('collection.to_cart')
                                    </button>
                                    <button class="btn btn-outline-primary" data-toggle="tooltip"
                                            title="@lang('collection.to_favorites')">
                                        <i class="fa fa-heart-o"></i>
                                    </button>

                                    <button class="btn btn-outline-primary" data-toggle="tooltip"
                                            title="@lang('collection.to_comparison')">
                                        <i class="fa fa-balance-scale"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <h4 class="centered">@lang('common.empty')</h4>
    @endforelse
</div>