@extends('catalog.layout')

@section('style')
    <style>
        .checkout-page, .checkout-products {
            box-shadow: 0 0 5px #ccc;
            /*margin-top: 15px;*/
            padding: 20px;
        }

        .checkout-page h3, .checkout-products h3 {
            color: #e31837;
            border-bottom: 1px solid #e31837;
            margin-bottom: 20px;
        }

        .disabled {
            pointer-events: none;
            color: #aaa;
        }

        .change-form {
            display: none;
        }

        a.checkout-product-image {
            width: 100px;
            height: 100px;
            display: block;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .checkout-products table {
            width: 100%;
        }

        .checkout-product {
            border-bottom: 1px solid #ccc;
        }

        .checkout-product:last-child {
            border-bottom: none;
        }
    </style>
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-6">
                <div class="checkout-page">

                    <form id="checkout">
                        @include('catalog.order.checkout.steps.contacts')

                        @include('catalog.order.checkout.steps.delivery', compact('order_types'))

                        @include('catalog.order.checkout.steps.pay')

                        @include('catalog.order.checkout.steps.more')
                    </form>

                </div>
            </div>

            <div class="col-6">
                <div class="checkout-products">

                    @include('catalog.order.checkout.products')

                </div>
            </div>
        </div>
    </div>

@stop

@section('script')

    <script>
        /**
         * Зберігання стану поля
         */
        $(document).on('focusout', '#checkout .form-control', function () {
            let $this = $(this);

            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['order', 'checkout_input']) }}',
                data: {name: $this.attr('name'), value: $this.val()}
            });
        });

        /**
         * Відправка форми
         */
        $(document).on('submit', '#checkout', function (event) {
            event.preventDefault();
            let $this = $(this);

            let data = $this.serializeJSON();

            $this.find('button').prepend('<i class="fa fa-spinner fa-pulse fa-fw"></i> ');
            $this.find('input, button, textarea, select').attr('disabled', true);

            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['order', 'checkout']) }}',
                data: data,
                success: function (answer) {
                    $this.find('input, button, textarea, select').attr('disabled', false);
                    $this.find('button').find('i.fa').remove();

                    // window.location.href = answer.redirectRoute;
                },
                error: function (answer) {
                    $this.find('input, button, textarea, select').attr('disabled', false);
                    $this.find('button').find('i.fa').remove();

                    answer = answer.responseJSON;

                    let title = 'title' in answer ? answer.title : '@lang('common.error')';
                    let message = 'message' in answer ? answer.message : '@lang('common.unknown_error')';

                    toastr.error(message, title);

                    if ('errors' in answer)
                        for (let field in answer.errors)
                            $('[name="' + field + '"]')
                                .addClass('is-invalid')
                                .parent()
                                .find('.feedback')
                                .addClass('text-danger')
                                .html(answer.errors[field]);
                }
            });
        });

        /**
         * Загрузка форми доставки
         */
        $(document).on('change', '[name="delivery"]', function () {
            let $this = $(this);
            let $form = $('#delivery-form');

            $form.css('background', '#eee');
            $form.find('input').attr('disabled', true);
            $form.find('button').attr('disabled', true);
            $form.append('<i id="form-loader" class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['order', 'get_delivery_type']) }}',
                data: {
                    type: $this.val()
                },
                success: function (answer) {

                    $form.css('background', '#fff');
                    $form.find('input').attr('disabled', false);
                    $form.find('button').attr('disabled', false);

                    setTimeout(function () {
                        $form.html(answer);
                    }, 300)
                },
                error: function (answer) {
                    Common.errorHandler(answer);

                    $form.css('background', '#fff');
                    $form.find('input').attr('disabled', false);
                    $form.find('button').attr('disabled', false);
                }
            })
        });

        $(document).on('click', '#btn-reg-user', function (answer) {
            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['user', 'login_form']) }}',
                data: {},
                success: function (answer) {
                    $('body').append(answer.content);

                    $('.modal').modal();
                }
            })
        });

        $(document).ready(function () {
            $('[name="phone"]').inputmask('999-999-99-99');
        });

        $(document).on('focus', '.form-control', function () {
            $(this)
                .removeClass('is-invalid')
                .parent()
                .find('.feedback')
                .removeClass('text-danger')
                .html('');
        });
    </script>

@endsection