@extends('catalog.layout')

@section('css')
    <link href="{{ asset('catalog/css/product_page.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
        <div class="container margin_30">
            @if($product->is_discounted)
                <div class="countdown_inner">-{{ $product->discount_percent }}% @translate('Ця знижка закічиться через')
                    <div data-countdown="{{ date('Y/m/d', time() + 3600 * 24 *3) }}" class="countdown"></div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                @foreach($product->images as $image)
                                    <div style="background-image: url({{ $image->big_image }});" class="item-box"></div>
                                @endforeach
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                @foreach($product->images as $image)
                                    <div style="background-image: url({{ $image->small_image }})"
                                         class="item {{ $loop->first ? 'active' : '' }}"></div>
                                @endforeach
                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@translate('Головна')</a></li>
                            <li>
                                <a href="{{ $product->category->parent->url }}">{{ $product->category->parent->name }}</a>
                            </li>
                            <li><a href="{{ $product->category->url }}">{{ $product->category->name }}</a></li>
                            <li>{{ $product->name }}</li>
                        </ul>
                    </div>
                    <!-- /page_header -->
                    <div class="prod_info">
                        <h1>{{ $product->name }}</h1>
                        <span class="rating">
                            {!! $product->stars !!}
                            <em>{{ $product->reviews->count() }} @translate('Відгук(ів)')</em>
                        </span>
                        <p>
                            <small>SKU: {{ $product->article }}</small>
                            <br>
                            Sed ex labitur adolescens scriptorem. Te saepe verear
                            tibique sed. Et wisi ridens vix, lorem iudico blandit mel cu. Ex vel sint zril oportere,
                            amet wisi aperiri te cum.
                        </p>
                        <div class="prod_options">
                            <div class="row">
                                <label class="col-xl-5 col-lg-5 col-md-6 col-6">
                                    <strong>Size</strong> - Size Guide
                                    <a href="#0" data-toggle="modal" data-target="#size-modal">
                                        <i class="ti-help-alt"></i>
                                    </a>
                                </label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="custom-select-form">
                                        <select class="wide">
                                            <option value="" selected>Small (S)</option>
                                            <option value="">M</option>
                                            <option value=" ">L</option>
                                            <option value=" ">XL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>@translate('Кількість')</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main">
                                    <span class="new_price">{{ $product->new_price }}</span>
                                    @if($product->is_discounted)
                                        <span class="percentage">-{{ $product->discount_percentage }}%</span>
                                        <span class="old_price">{{ $product->old_price }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="btn_add_to_cart"><a href="#0" class="btn_1">@translate('В корзину')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_actions">
                        <ul>
                            <li>
                                <a href="#"><i class="ti-heart"></i><span>@translate('Додати в бажане')</span></a>
                            </li>
                            <li>
                                <a href="#"><i
                                            class="ti-control-shuffle"></i><span>@translate('Додати до порівняння')</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab"
                           role="tab">@translate('Опис')</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab"
                           role="tab">@translate('Відгуки')</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                   aria-controls="collapse-A">
                                    @translate('Опис')
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <h3>@translate('Деталі')</h3>
                                        {!! $product->description !!}
                                    </div>
                                    <div class="col-lg-5">
                                        <h3>@translate('Характеристики')</h3>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <tbody>
                                                @foreach($product->characteristics as $characteristic)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $characteristic->characteristic->name }}</strong>
                                                        </td>
                                                        <td>{{ $characteristic->value }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /TAB A -->
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                   aria-controls="collapse-B">
                                    Reviews
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i
                                                            class="icon-star"></i><i class="icon-star"></i><i
                                                            class="icon-star"></i><i
                                                            class="icon-star"></i><em>5.0/5.0</em></span>
                                                <em>Published 54 minutes ago</em>
                                            </div>
                                            <h4>"Commpletely satisfied"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola
                                                sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat
                                                legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut.
                                                Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i
                                                            class="icon-star"></i><i class="icon-star"></i><i
                                                            class="icon-star empty"></i><i
                                                            class="icon-star empty"></i><em>4.0/5.0</em></span>
                                                <em>Published 1 day ago</em>
                                            </div>
                                            <h4>"Always the best"</h4>
                                            <p>Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                                fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                                petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i
                                                            class="icon-star"></i><i class="icon-star"></i><i
                                                            class="icon-star"></i><i class="icon-star empty"></i><em>4.5/5.0</em></span>
                                                <em>Published 3 days ago</em>
                                            </div>
                                            <h4>"Outstanding"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola
                                                sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat
                                                legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut.
                                                Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i
                                                            class="icon-star"></i><i class="icon-star"></i><i
                                                            class="icon-star"></i><i
                                                            class="icon-star"></i><em>5.0/5.0</em></span>
                                                <em>Published 4 days ago</em>
                                            </div>
                                            <h4>"Excellent"</h4>
                                            <p>Sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea,
                                                ius essent fuisset ut. Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-right"><a href="leave-review.html" class="btn_1">Leave a review</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($product->related->count())
            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>@translate('Схожі товари')</h2>
                    <span>@translate('Товари')</span>
                    <p>@translate('Наших покупців також цікавлять')</p>
                </div>
                <div class="owl-carousel owl-theme products_carousel">
                    @foreach($product->related as $related)
                        <div class="item">
                            <div class="grid_item">
                                @if($related->is_discounted)
                                    <span class="ribbon off">-{{ $related->discount_percent }}%</span>
                                @elseif($related->is_new)
                                    <span class="ribbon new">@translate('Новинка')</span>
                                @elseif($related->is_recommended)
                                    <span class="ribbon hot">@translate('Рекомендовано')</span>
                                @endif
                                <figure>
                                    <a href="{{ $related->url  }}">
                                        <img class="owl-lazy" src="{{ $related->small_image }}"
                                             data-src="{{ $related->big_image }}" alt="{{ $related->name }}">
                                    </a>
                                </figure>
                                <div class="rating">{!! $related->stars !!}</div>
                                <a href="{{ $related->url }}">
                                    <h3>{{ $related->name }}</h3>
                                </a>
                                <div class="price_box">
                                    <span class="new_price">{{ $related->new_price }}</span>
                                    @if($related->is_discounted)
                                        <span class="old_price">{{ $related->old_price }}</span>
                                    @endif
                                </div>
                                <ul>
                                    <li>
                                        <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites">
                                            <i class="ti-heart"></i>
                                            <span>Add to favorites</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare">
                                            <i class="ti-control-shuffle"></i>
                                            <span>Add to compare</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
                                            <i class="ti-shopping-cart"></i>
                                            <span>Add to cart</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="feat">
            <div class="container">
                <ul>
                    <li>
                        <div class="box">
                            <i class="ti-gift"></i>
                            <div class="justify-content-center">
                                <h3>@translate('Безкоштовна доставка')</h3>
                                <p>@translate('Від 100 грн')</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-wallet"></i>
                            <div class="justify-content-center">
                                <h3>@translate('Захищені платежі')</h3>
                                <p>@translate('100% захисту ваших платежів')</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-headphone-alt"></i>
                            <div class="justify-content-center">
                                <h3>@translate('24/7 Підтримка')</h3>
                                <p>@translate('Онлайн підтримка')</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('catalog/js/carousel_with_thumbs.js') }}"></script>
@endsection