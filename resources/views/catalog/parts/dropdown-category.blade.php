<div class="col-lg-3 col-md-3">
    <div class="b-hbs-catalog">
        <div class="b-hbs-catalog-toggler">Каталог товаров</div>
        <div class="b-hbs-catalog-backdrop"></div>
        <nav class="b-hbs-catalog-popup" style="display: none;">
            <ul class="b-hbs-catalog-popup-list">
                @foreach($categories as $category)
                    @if($category->is_link)
                        <li>
                            <a class="b-hbsc-link" href="{{ url($category->slug) }}">
                                <span><i class="b-help-inner">{{ $category->name }}</i></span>
                            </a>
                        </li>
                    @else
                        <li class="is-parent">
                            <a class="b-hbsc-link" href="{{ $category->url }}">
                                <span><i class="b-help-inner">{{ $category->name }}</i></span>
                            </a>
                            <div class="b-hbsc-popup"
                                 @if($category->child->count() > 10) style="min-width: 600px;column-count: 2;" @endif>
                                <div class="b-hbsc-popup-inner">
                                    <ul class="b-hbsc-list-level-2">
                                        @foreach($category->child as $child)
                                            <li>
                                                <a href="{{ $child->url }}">
                                                    {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
{{--                                    <div class="b-hbsc-product-of-day product_wrapper" data-price="29833"--}}
{{--                                         data-id_product="333287">--}}
{{--                                        <div class="b-title">Товар дня</div>--}}
{{--                                        <div class="b-i-product">--}}
{{--                                            <div class="b-i-product-name">--}}
{{--                                                <a href="{{ url('/') }}" title="name product">NAME PRODUCT</a></div>--}}
{{--                                            <div class="b-i-product-top-meta clearfix">--}}
{{--                                                <div class="b-i-product-ratio">--}}
{{--                                                    <ul class="b-i-product-ratio-list">--}}
{{--                                                        <li>--}}
{{--                                                            <div class="b-ratio-num">4.9</div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="b-i-product-articul">@translate('Артикул'): <i>333287</i>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="b-i-product-pic">--}}
{{--                                                <div class="b-i-product-pic-td">--}}
{{--                                                    <a href="https://telemart.ua/products/evolve-optipart-silver-b-evop-sbi940fn166s-16s240gbk-black/">--}}
{{--                                                        <img class="lazy_click" width="245" height="245"--}}
{{--                                                             alt="Name product"--}}
{{--                                                             src="link-to-img-product"--}}
{{--                                                             style="display: inline-block;">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                            <div class="b-i-product-bot-meta clearfix">--}}
{{--                                                <div class="b-price">29 833 <i>грн</i></div>--}}


{{--                                                <a class="b-link-add2bas " href="javascript: void(0);">Купить</a>--}}


{{--                                                <a class="b-link-add2compare" href="javascript:void(0);">К сравнению</a>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</div>