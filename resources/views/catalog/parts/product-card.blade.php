@php
    $characteristics = "";
    foreach($product->characteristics as $characteristic) {
        $name = $characteristic->getName();
        $prefix = $characteristic->getPrefix();
        $value = $characteristic->value;
        $postfix = $characteristic->getPostfix();
        $characteristics .= "<strong>$name</strong> $prefix $value $postfix <br>";
    }
@endphp
<div class="grid_item"
     data-html="true"
     data-toggle="popover"
     data-trigger="hover"
     title="Характеристики"
     data-content="{!! $characteristics !!}"
>
    @if(!$product->on_storage)
        <span class="ribbon off">@translate('Нету в наличии')</span>
    @elseif($product->is_discounted)
        <span class="ribbon off">-{{ $product->discount_percent }}%</span>
    @elseif($product->is_new)
        <span class="ribbon new">@translate('Новинка')</span>
    @elseif($product->is_recommended)
        <span class="ribbon hot">@translate('Рекомендовано')</span>
    @endif
    <figure>
        <a href="{{ $product->url }}">
            <img class="img-fluid lazy" src="{{ $product->small_image }}"
                 data-src="{{ $product->small_image }}" alt="{{ $product->name }}">
        </a>
        @if($product->is_discounted)
            <div data-countdown="{{ date('Y/m/d', time() + 3600 * 24 * 3) }}"
                 class="countdown"></div>
        @endif
    </figure>
    <a href="{{(!empty($product->rating)) ? route('product.view', $product->id) . '?rev=1' : route('product.leave_review', $product->id)}}">
        {!! $product->stars !!}
        <em>{{ $product->reviews_count }} @translate('Відгук(ів)')</em>
    </a>
    <br>
    <a href="{{ $product->url }}">
        <h3>{{ $product->name }}</h3>
    </a>
    <div class="price_box">
        <span class="new_price">₴ {{ $product->new_price }}</span>
        @if($product->is_discounted)
            <span class="old_price">₴ {{ $product->old_price }}</span>
        @endif
    </div>
    <ul>
        @if($product->video)
            <li class="tooltip-1 li-video" data-toggle="tooltip" data-placement="left"
                title="Дивитись відео">
                <a class="click-video d-none d-xl-block" href="#0"
                   data-video-id="{{$product->video}}"
                   data-video-title="{{$product->name}}"
                   data-toggle="modal"
                   data-target="#video-window">
                    <i class="ti-youtube"></i>
                    <span>Дивитись відео</span>
                </a>
            </li>
        @endif
    </ul>
</div>
<ul class="grid_item_2">
    <li>
        <a href="javascript:void(0)" data-type="cart_attach"
           data-id="{{ $product->id }}" class="tooltip-1 cart-button">
            <i class="ti-shopping-cart"></i>
            <span>@translate('В корзину')</span>
        </a>
    </li>

    <li class="tooltip-1" @tooltip(translate('Придбати в 1 клік'), 'bottom')>
        <a class="click-one-click-order" href="javascript:void(0)" data-toggle="modal"
           data-target="#one-click-order-window" data-id="{{ $product->id }}">
            <i class="ti-hand-point-up"></i>
        </a>
    </li>

    {{-- if customer is authtenticated in system then show "add to desire" button --}}
    @if(isAuth())
        <li>
            <a href="javascript:void(0)" data-type="switchDesire"
               data-id="{{ $product->id }}"
               @tooltip(translate('Додати в список бажаних'), 'bottom')
               class="tooltip-1 @displayIf(customer()->hasDesire($product->id), 'desire-attached')"
            >
                <i class="ti-heart"></i>
            </a>
        </li>
    @endif

    @if($product->video)
        <li class="tooltip-1" @tooltip(translate('Дивитись відео'), 'bottom')>
            <a class="click-video d-md-block d-lg-none" href="#0"
               data-video-id="{{ $product->video }}"
               data-video-title="{{ $product->name }}"
               data-toggle="modal"
               data-target="#video-window"
               style="color: white; background-color: red;"
            >
                <i class="ti-youtube"></i>
            </a>
        </li>
    @endif
</ul>

@pushonce('modals:productCardModals')
 <!-- Modal Video-->
    <div class="modal fade" id="video-window" tabindex="-1" role="dialog" aria-labelledby="video_title"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="video_title"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="iframe-video" class="embed-responsive-item"
                                src="//www.youtube.com/embed/EvxDxOVzz24" frameborder="0" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('catalog.parts.one-click-order-window')
@endpushonce
