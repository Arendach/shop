@extends('catalog.layout')

@section('style')

    <style>
        .page {
            margin-top: 20px;
            box-shadow: 0 0 5px #eee;
            padding: 20px 10px;
        }


        .product {
            margin-bottom: 10px;
            padding: 10px;
        }

        .product:hover {
            box-shadow: 0 0 10px #ccc;
        }

        .cart-product-minus, .cart-product-plus, .cart-product-amount {
            color: #e31837;
            cursor: pointer;
            height: 30px;
            display: inline-block;
            border: 1px solid #e31837;
            text-align: center;
            padding: 2px 7px;
        }

        .cart-product-minus:hover, .cart-product-plus:hover {
            font-weight: bold;
        }

        .cart-product-minus:hover, .cart-product-plus:hover {
            color: #fff;
            background: #e31837;
        }

        .cart-product-amount {
            width: 50px;
            border-left: none;
            border-right: none;
            cursor: default;
        }

        .cart-product-price {
            color: #e31837;
        }

        .cart-products-sum {
            padding: 0 10px;
            /*box-shadow: 0 0 5px #ccc;*/
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <div class="page">
            @if (!is_null($cart) && $cart->products->count())
                @foreach($cart->products as $item)
                    <div class="product" data-id="{{ $item->id }}">
                        <div class="row">
                            <div class="col-1">
                                <a href="{{ route('product.view', $item->product->slug) }}">
                                    <img width="100%" src="{{ $item->product->small }}"
                                         alt="{{ $item->product->name }}">
                                </a>
                            </div>

                            <div class="col-3">
                                <a href="{{ route('product.view', $item->product->slug) }}">
                                    {{ $item->product->name }}
                                </a>
                            </div>

                            <div class="col-2">
                                <a href="{{ route('category.show', $item->product->category->slug) }}">
                                    {{ $item->product->category->name }}
                                </a>
                            </div>

                            <div class="col-2">
                                <span class="cart-product-minus"><i class="fa fa-minus"></i></span><span
                                        class="cart-product-amount">{{ $item->amount }}</span><span
                                        class="cart-product-plus"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="col-3">
                                <span class="cart-product-price">
                                    @if (is_null($item->product->getOriginal('discount')))
                                        {{ $item->product->getOriginal('price') }} грн
                                    @else
                                        <b>{{$item->product->getOriginal('discount')}} грн</b>
                                        <s style="color: #ccc; font-size: 14px">
                                            {{ $item->product->getOriginal('price') }} грн
                                        </s>
                                    @endif
                                </span>
                            </div>

                            <div class="col-1">
                                <button class="btn btn-sm btn-outline-danger remove_from_cart">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <hr>

                <div class="cart-products-sum right">
                    Товарів:
                    <span class="text-primary cart_products_count">{{ $cart->products->count() }}</span><br>
                    На суму:
                    <span class="text-primary" id="cart_products_sum">
                        {{ number_format(\Cart::getProductsSum(), 2) }}
                    </span>
                    грн
                    <br>
                    <a href="{{ route('checkout', 'contacts') }}" style="margin-top: 10px"
                       class="btn btn-outline-primary">
                        Оформимти замовлення
                    </a>
                </div>
            @else
                <h4>@lang('cart.empty')</h4>
            @endif
        </div>
    </div>

@endsection


@section('script')

    <script>

        function changeAmountAjax(id, amount) {
            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['cart', 'change_amount']) }}',
                data: {
                    id: id,
                    amount: amount
                },
                success: function (answer) {
                    $('#cart_products_sum').html(answer.cart_products_sum);
                    $('#cart_products_count').html(answer.cart_products_count);
                    $('.cart-product-plus, .cart-product-minus').attr('disabled', false);

                },
                error: function (answer) {
                    toastr.error(answer.responseJSON.message, JS.error);
                    $('.cart-product-plus, .cart-product-minus').attr('disabled', false);
                }
            })
        }

        $(document).on('click', '.cart-product-minus', function () {
            if ($(this).attr('disabled')) return;

            let id = $(this).parents('.product').data('id');
            let $amount = $(this).parent().find('.cart-product-amount');
            let old = +$amount.html();

            let new_ = old - 1 < 1 ? 1 : old - 1;
            $amount.html(new_);

            changeAmountAjax(id, new_)
        });

        $(document).on('click', '.cart-product-plus', function () {
            if ($(this).attr('disabled')) return;

            let id = $(this).parents('.product').data('id');
            let $amount = $(this).parent().find('.cart-product-amount');
            let old = +$amount.html();
            $amount.html(old + 1);

            $('.cart-product-plus, .cart-product-minus').attr('disabled', true);

            changeAmountAjax(id, old + 1);
        });

        $(document).on('click', '.remove_from_cart', function () {
            let $this = $(this);

            let id = $this.parents('.product').data('id');

            $this.attr('disabled', true);
            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['cart', 'remove']) }}',
                data: {id: id},
                success: function (answer) {
                    $('#cart_products_count').html(answer.cart_products_count);
                    $('.cart_products_count').html(answer.cart_products_count);
                    $('#cart_products_sum').html(answer.cart_products_sum);
                    toastr.success(answer.message, answer.title);
                    $this.parents('.product').fadeOut().remove();
                },
                error: function (answer) {
                    toastr.error(answer.responseJSON.message, answer.responseJSON.title);
                    $this.attr('disabled', false);
                }
            });
        });
    </script>

@endsection