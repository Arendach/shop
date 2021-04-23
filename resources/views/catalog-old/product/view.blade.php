@extends('catalog-old.layout')

@section('style')

    <style>
        .image-gallery {
            margin-top: 20px;
        }

        .image-slider {
            position: relative;
            height: 90px;
            overflow: hidden;
            margin-top: 5px;
        }

        .image-slider-next, .image-slider-prev {
            position: absolute;
            z-index: 2;
            top: 0;
            height: 90px;
            width: 28px;
            font-size: 40px;
            background: #888;
            color: #fff;
            padding-top: 10px;
            padding-left: 7px;
        }

        .image-slider-prev {
            left: 0;

        }

        .image-slider-next {
            right: 0;
        }

        .image-slider-items {
            position: absolute;
            left: 30px;
            width: calc(100% - 60px);
            white-space: nowrap;
            right: 30px;
        }

        .image-slider-item {
            margin-left: -2px;
            display: inline-block;
            height: 90px;
            background: #0f6674;
            cursor: pointer;
        }

        .product-price {
            padding: 10px;
            border: 1px dashed #ddd;
        }

        .product-description {
            padding: 10px;
            border: 1px dashed #ddd;
            margin-top: 10px;
        }

        .price {
            margin-top: 5px;
        }

        .price-new {
            font-size: 26px;
            display: inline-block;
        }

        .price-old {
            font-size: 22px;
            color: #ccc;
            text-decoration: line-through;
            display: inline-block;
        }

        .to-buy {
            margin-top: 5px;
        }

        .to-buy-click {
            text-align: right;
        }

        .on-storage {
            font-size: 16px;
        }

        .delivery-pay {
            padding: 10px;
            border: 1px dashed #ddd;
        }

        .review {
            padding: 10px 0;
            border-bottom: 1px dashed #ccc;
        }

        .review:last-child {
            border-bottom: none;
        }

        .review-date {
            font-size: 12px;
            color: #ccc;
            text-align: right;
        }

        .review-comment-text, .review-plus, .review-minus {
            font-size: 14px;
        }

        .review-user {
            font-weight: bolder;
            color: #666;
            font-size: 14px;
            /*text-align: right;*/
        }

        .review-rating img {
            width: 16px;
            height: 16px;
        }

        .review-rating span {
            display: inline-block;
            line-height: 1
        }

        .review-rating {
            line-height: 1;
            margin: 5px 0;
        }

        .review-comment {
            padding: 10px;
            border-bottom: 1px dashed #eee;
            margin-left: 40px;
        }

        .review-comment:last-child {
            border-bottom: none;
        }

        .review-thumb {
            text-decoration: none;
            cursor: pointer;
        }

        .review-thumb:hover {
            text-decoration: none;
        }

        .review-thumb-up {
            color: #23972f;
        }

        .review-thumb-down {
            color: #ac0d00;
        }

        .review-thumb-up:hover {
            color: #1d7026;
        }

        .review-thumb-down:hover {
            color: #780d00;
        }

        .review-answer {
            margin-top: 10px;
        }

        .review-answer-button:hover {
            text-decoration: none;
        }

        .review-answer-place {
            position: relative;
        }


        #create_review { /* Коментар до відгука */
            border: 1px solid #ccc;
            border-radius: 5px;
            position: absolute;
            top: 0;
            left: 0;
            background-color: #fff;
            padding: 15px;
            z-index: 2;
            width: 100%;
        }

        #create-review { /* Форма створення відгука */
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }

        .star {
            cursor: pointer;
        }

        .review-actions {

        }

        .review-action {
            cursor: pointer;
            border: 1px solid;
            width: 20px;
            height: 20px;
            display: inline-block;
            line-height: 1;
            text-align: center;
            border-radius: 3px;
            font-size: 16px;
            transition: .5s;
        }

        .review-action-edit {
            border-color: #158ce0;
            color: #158ce0;
        }

        .review-action-edit:hover {
            background-color: #158ce0;
            color: #fff;
        }


        .review-action-remove {
            color: #ce2a2acc;
            border-color: #ce2a2acc;
        }

        .review-action-remove:hover {
            background-color: #ce2a2acc;
            color: #fff;
        }

        .review-comment .review-actions {
            display: none;
        }


        .review-comment:hover .review-actions {
            display: inline-block;
        }

        .review-comment:hover {
            box-shadow: 0 0 10px #ccc;
        }

        .review-body {
            padding: 10px;
        }

        .review-body:hover {
            box-shadow: 0 0 10px #ccc;
        }

        .review-body .review-actions {
            display: none;
        }

        .review-body:hover .review-actions {
            display: inline-block;
        }

        .reviews-not-found {
            margin: 20px 0;
            text-align: center;
            font-size: 26px;
            padding: 15px;
            border: 1px dashed #ccc;
        }


    </style>

    <style>
        .relation-products {
            margin-top: 20px
        }

        .relation-product {
            border: 1px dashed #ccc;
            /*border-radius: 5px;*/
            padding: 10px;
        }

        .relation-product:hover {
            border: 1px solid #ccc;
            box-shadow: 0 0 10px #ccc;
        }

        .relation-product .relation-old-price {
            text-decoration: line-through;
            color: #cccc;
        }

        .relation-product .relation-new-price {
            font-size: 23px;
            color: #e31837;
        }

        .relation-price {
            margin: 0;
        }

        .relation-name {
            margin: 10px 0 0 0;
            font-size: 18px;
        }
    </style>

@endsection

{{----------------------------------------------------------------------------------}}

@section('content')

    <div class="container">

        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#main">@translate('Опис товару')</a>
            </li>
            @if(count($product->characteristics))
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#characteristics">@translate('Характеристики')</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#comments">@translate('Відгуки')</a>
            </li>
        </ul>

        <br>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="main">
                <div class="row">

                    {{-- Фотогалерея --}}
                    <div class="col-4">
                        <div class="main-image" data-toggle="modal" data-target="#image-modal">
                            <img width="100%" src="{{ $product->big }}" alt="">
                        </div>

                        @if(count($product->images) > 1)
                            <div class="image-slider">
                                <div class="image-slider-prev">&lsaquo;</div>
                                <div class="image-slider-items">
                                    @foreach($product->images as $item)
                                        <div class="image-slider-item" data-src="{{ $item->small }}">
                                            <img height="100%" src="{{ $item->small }}" alt="1">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="image-slider-next">&rsaquo;</div>
                            </div>
                        @endif
                    </div>

                    {{-- Інформація про товар --}}

                    <div class="col-5">

                        <div class="product-price">
                            <div class="row">
                                <div class="col-6">
                                    <div class="price centered">
                                        @if($product->discount != 0)
                                            <span class="price-new text-success">
                                        <span class="text-primary">₴</span>{{ $product->discount }}
                                    </span> <br>
                                            <span class="price-old">{{ $product->price }}</span>
                                        @else
                                            <span class="price-new text-success">
                                        <span class="text-primary">₴</span>{{ $product->price }}
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 centered">
                                    <div class="on-storage">
                                        @if($product->on_storage)
                                            <span class="text-success">
                                        <i class="fa fa-check"></i> @translate('В наявності')
                                    </span>
                                        @else
                                            <span class="text-danger">
                                        <i class="fa fa-remove"></i> @translate('Немає в наявності')
                                    </span>
                                        @endif
                                    </div>

                                    <div class="to-buy">
                                        <button class="btn btn-primary btn-block">@translate('В корзину')</button>
                                    </div>

                                    <div class="to-buy-click">
                                        <a href="#" data-toggle="modal" data-target="#simple-buy">@translate('Купити в
                                            один клік')</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="product-description">
                            {!! htmlspecialchars_decode($product->description) !!}
                        </div>
                    </div>

                    {{-- Умови доставки --}}

                    <div class="col-3">

                        <div class="delivery-pay">
                            @translate('Мінімальна сума замовлення НА ДОСТАВКУ') <br> <span class="text-primary">@translate('300грн')</span>
                            (@translate('без доставки')
                            <hr>
                            @translate('Доставка') <span class="text-success">@translate('с 10:00 до 20:00')</span> <br>
                            <span class="text-primary">@translate('80грн')</span>
                            (<span class="text-primary">@translate('от 1000 - 0грн')</span>)
                            <hr>
                            @translate('Доставка') <span class="text-success">@translate('с 8:00 до 10:00')</span> и
                            <span class="text-success">@translate('с 20:00 до 22:00')</span>
                            <br> <span class="text-primary">@translate('100грн')</span> (<span
                                    class="text-primary">@translate('от 1000 - 70грн')</span>)
                            <hr>
                            @translate('Доставка') <span class="text-success">@translate('с 22:00 до 8:00')</span> <br>
                            <span class="text-primary">@translate('ОТ 200грн')</span>
                            (<span class="text-primary">@translate('от 1000 - 100грн')</span>)
                        </div>
                    </div>
                </div>
            </div>

            @if(count($product->characteristics))
                <div class="tab-pane fade" id="characteristics">
                    <table class="table table-striped table-bordered table-sm">
                        @foreach($product->characteristics as $item)
                            <tr>
                                <td>{{ $item->characteristic->name }}</td>
                                <td>{{ $item->characteristic->prefix }} {{ $item->value }} {{ $item->characteristic->postfix }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif

            <div class="tab-pane fade" id="comments">

                <div class="reviews">
                    <div class="reviews-head">
                        <div class="row">
                            <div class="col-9">
                                <h4>@translate('Відгуки та запитання'): {{ $product->name }}</h4>
                            </div>

                            <div class="col-3 right">
                                <a href="#review-create-form" class="btn btn-outline-primary">@translate('Написати
                                    відгук')</a>
                            </div>
                        </div>
                    </div>
                    @if($product->reviews->count())
                        @foreach($product->reviews as $item)
                            <div class="review" id="review-{{ $item->id }}">
                                <div class="review-body">
                                    <span class="review-user">{{ $item->user->name ?? '' }}</span>
                                    ●
                                    <span class="review-date">{{ $item->created_at->diffForHumans() }}</span>

                                    @if(access('product') || user()->id == $item->user_id)
                                        <span class="pull-right">
                                            <span class="review-actions">
                                                 <span onclick="getForm('{{ $item->id }}', '{{ route('catalog.post', ['product', 'review_update_form']) }}')"
                                                       class="review-action review-action-edit"
                                                       title="Редагувати"
                                                       data-toggle="tooltip">
                                                    <i class="fa fa-pencil"></i>
                                                </span>
                                                <span onclick="deleteReview({{ $item->id }})"
                                                      class="review-action review-action-remove"
                                                      title="Видалити"
                                                      data-toggle="tooltip">
                                                    <i class="fa fa-remove"></i>
                                                </span>
                                            </span>
                                        </span>
                                    @endif

                                    @if($item->rating != 0)
                                        <div class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span>
                                                    @if($i <= $item->rating)
                                                        <img src="{{ asset('catalog/img/star-active.png') }}">
                                                    @else
                                                        <img src="{{ asset('catalog/img/star-no-active.png') }}">
                                                    @endif
                                                </span>
                                            @endfor
                                        </div>
                                    @endif
                                    @if(!empty($item->plus))
                                        <div class="review-plus">
                                            @translate('Достоїнства'):
                                            <span class="text-success">
                                                {{ $item->plus }}
                                            </span>
                                        </div>
                                    @endif

                                    @if(!empty($item->minus))
                                        <div class="review-minus">
                                            @translate('Недоліки'):
                                            <span class="text-warning">{{ $item->minus }}</span>
                                        </div>
                                    @endif

                                    <div class="review-comment-text">
                                        @translate('Коментар'):
                                        <span class="text-info">{{ $item->comment }}</span>
                                    </div>
                                    <div class="review-answer">
                                        <div class="row">
                                            <div class="col-6">
                                                <a data-id="{{ $item->id }}" class="review-answer-button" href="#">
                                                    @translate('Відповісти')
                                                </a>
                                                <div class="review-answer-place"></div>
                                            </div>
                                            <div class="col-6 right">
                                                <span data-id="{{ $item->id }}"
                                                      data-quality="{{ $item->thumb != null && $item->thumb->quality == 1 ? 0 : 1 }}"
                                                      onclick="thumb(this)"
                                                      class="review-thumb review-thumb-up">
                                                    <i class="fa fa-thumbs-o-up"></i>
                                                    <span id="thumb-up-{{ $item->id }}">
                                                        {{ $item->thumb_up }}
                                                    </span>
                                                </span> |
                                                <span data-id="{{ $item->id }}"
                                                      data-quality="{{ $item->thumb != null && $item->thumb->quality == -1 ? 0 : -1 }}"
                                                      onclick="thumb(this)"
                                                      class="review-thumb review-thumb-down">
                                                    <i class="fa fa-thumbs-o-down"></i>
                                                    <span id="thumb-down-{{ $item->id }}">
                                                        {{ $item->thumb_down }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="review-comments">
                                    @if($item->comments->count())
                                        @foreach($item->comments as $comment)
                                            <div class="review-comment" id="review-comment-{{ $comment->id }}">
                                                <span class="review-user">{{ $comment->user->name ?? '' }}</span>
                                                ●
                                                <span class="review-date">{{ $comment->created_at->diffForHumans() }}</span>

                                                @if(access('product') || user()->id == $comment->user_id)
                                                    <span class="pull-right">
                                                        <span class="review-actions">
                                                            <span onclick="getForm('{{ $comment->id }}', '{{ route('catalog.post', ['product', 'review_comment_update_form']) }}')"
                                                                  class="review-action review-action-edit"
                                                                  title="@translate('Редагувати')"
                                                                  data-toggle="tooltip">
                                                                <i class="fa fa-pencil"></i>
                                                            </span>
                                                            <span onclick="deleteReviewComment({{ $comment->id }})"
                                                                  class="review-action review-action-remove"
                                                                  title="@translate('Видалити')"
                                                                  data-toggle="tooltip">
                                                                <i class="fa fa-remove"></i>
                                                            </span>
                                                        </span>
                                                    </span>
                                                @endif

                                                <div class="review-comment-text">{{ $comment->comment }}</div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="reviews-not-found">
                            @translate('Відгуки не знайдені! Ви можете написати першим!')
                        </div>
                    @endif
                </div>

                <form id="create-review" onsubmit="this.preventDefault(); createReview(this)">
                    <a href="" id="review-create-form"></a>

                    <div class="form-group">
                        <label>@translate('Ваша оцінка')</label>
                        <div class="stars" data-it="1">
                            <span class="star" data-it="1">
                                <img src="{{ asset('catalog/img/star-active.png') }}">
                            </span>

                            <span class="star" data-it="2">
                                <img src="{{ asset('catalog/img/star-no-active.png') }}">
                            </span>

                            <span class="star" data-it="3">
                                <img src="{{ asset('catalog/img/star-no-active.png') }}">
                            </span>

                            <span class="star" data-it="4">
                                <img src="{{ asset('catalog/img/star-no-active.png') }}">
                            </span>

                            <span class="star" data-it="5">
                                <img src="{{ asset('catalog/img/star-no-active.png') }}">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plus">@translate('Достоїнства товару')</label>
                        <input id="plus" name="plus" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="minus">@translate('Недоліки товару')</label>
                        <input id="minus" name="minus" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="comment">@translate('Коментар')</label>
                        <textarea id="comment" name="comment" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-primary">
                            @if(!is_auth())
                                <i class="fa fa-lock"></i>
                            @endif
                            @translate('Написати')
                        </button>
                    </div>

                    @if(!is_auth())
                        <div style="margin-bottom: 0;" class="form-group">
                            @translate('Для того щоб написати відгук необхідно ') <a href="{{ route('login') }}">@translate('авторизуватись!')</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

    </div>

    @if($product->relation->count())
        <div class="container">
            <div class="relation-products">
                <h2>@translate('Рекомендуємо також:')</h2>
                <div class="row">
                    @foreach($product->relation as $relation)
                        <div class="col-3">
                            <div class="relation-product">
                                <a href="{{ route('product.view', $relation->product->slug) }}">
                                    <img width="100%" src="{{ $relation->product->small }}" alt="">
                                </a>
                                <div class="relation-name">
                                    <a href="{{ route('product.view', $relation->product->slug) }}"
                                       class="text-success">
                                        {{ $relation->product->name }}
                                    </a>
                                </div>
                                <div class="relation-price">
                                    @if($relation->product->discount != null)
                                        <span class="relation-new-price">
                                            {{ $relation->product->discount }}
                                        </span>
                                        <span class="relation-old-price">
                                            {{ $relation->product->price }}
                                        </span>
                                    @else
                                        <span class="relation-new-price">
                                            {{ $relation->product->price }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

@endsection

{{------------------------------------------------------------------------------------}}

@section('modal')

    <div style="z-index: 99999999999" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
         id="image-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5>{{ $product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($product->images as $item)
                        <img src="{{ $item->big }}" width="100%" alt="">

                        @if(!$loop->last)
                            <br><br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div style="z-index: 9999999" class="modal fade" id="simple-buy">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5>{{ $product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="simple-buy-form">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label>@translate('Імя')</label>
                            <input class="form-control form-control-sm" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>@translate('Телефон')</label>
                            <input class="form-control form-control-sm" name="phone" required>
                        </div>

                        <div style="margin-bottom: 0;" class="form-group">
                            <button class="btn btn-outline-primary btn-sm">@translate('Оформити')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

{{--------------------------------------------------------------------------------------}}

@section('script')

    <script>
        @if(is_auth())

        function thumb(t) {
            let quality = $(t).data('quality');
            let review_id = $(t).data('id');

            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['product', 'thumb']) }}',
                data: {
                    quality,
                    review_id
                },
                success(answer) {
                    $('#thumb-up-' + review_id)
                        .html(answer.thumb_up)
                        .parents('.review-thumb')
                        .data('quality', answer.thumb_up_quality);

                    $('#thumb-down-' + review_id)
                        .html(answer.thumb_down)
                        .parents('.review-thumb')
                        .data('quality', answer.thumb_down_quality);

                    // $('#thumb-up-' + review_id).parents('.review-tumb').data('quality', answer.thumb_up_quality);
                },
                error() {

                }
            });
        }

        function deleteReviewComment(id) {
            deleteAbstract(id, '{{ route('catalog.post', ['product', 'delete_review_comment']) }}', function () {
                swal.close();

                let comment = $('#review-comment-' + id);
                comment.fadeOut(400);
                setTimeout(function () {
                    comment.remove();
                }, 400);
            });
        }

        function deleteReview(id) {
            deleteAbstract(id, '{{ route('catalog.post', ['product', 'delete_review']) }}', function () {
                swal.close();

                let comment = $('#review-' + id);
                comment.fadeOut(400);
                setTimeout(function () {
                    comment.remove();
                }, 400);
            });
        }

        function deleteAbstract(id, url, success) {
            swal({
                type: 'warning',
                text: '@lang('common.delete.confirm_text')',
                title: '@lang('common.delete.confirm_title')',
                closeOnConfirm: false,
                showCancelButton: true,
                cancelButtonText: '@lang('common.cancel')',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('common.delete.confirm')'
            }, function () {
                $.ajax({
                    type: 'post',
                    url,
                    data: {id},
                    success(answer) {
                        swal({
                            type: 'success',
                            text: answer.message,
                            title: answer.title,
                            closeOnConfirm: false
                        }, success);
                    },
                    error(answer) {
                        let title = 'title' in answer.responseJSON ? answer.responseJSON.title : '@lang('common.delete.error_title')';
                        let text = 'message' in answer.responseJSON ? answer.responseJSON.message : '@lang('common.delete.error_text')';

                        swal({
                            type: 'error',
                            title,
                            text
                        });
                    }
                });
            });
        }

        function getForm(id, url) {
            $.ajax({
                type: 'post',
                url,
                data: {id},
                success(answer) {
                    $('body').append(answer);

                    $('#modal').modal();
                },
                error(answer) {
                    Common.errorHandler(answer);
                }
            });
        }

        function getReviewAnswerForm() {
            $(document).on('click', '.review-answer-button', function (event) {
                event.preventDefault();
                let $this = $(this);

                $.ajax({
                    type: 'post',
                    url: '{{ route('catalog.post', ['product', 'create_review_comment_form']) }}',
                    data: {
                        id: $this.data('id')
                    },
                    success(answer) {
                        $this.parent().find('.review-answer-place').html(answer);
                    },
                    error(answer) {
                        Common.errorHandler(answer);
                    }
                });
            });
        }

        function createReview(event) {
            event.preventDefault();

            let $this = $(event);

            let data = {
                rating: $this.find('.stars').data('it'),
                comment: $this.find('[name="comment"]').val(),
                plus: $this.find('[name="plus"]').val(),
                minus: $this.find('[name="minus"]').val(),
                product_id: '{{ $product->id }}'
            };

            $.ajax({
                type: 'post',
                data,
                url: '{{ route('catalog.post', ['product', 'create_review']) }}',
                success(answer) {
                    toastr.success('Виконано!', 'Ваш відгук прийнято і відправлено на модерацію!');
                    $this.remove();
                },
                error(answer) {
                    toastr.error('Помилка', answer.responseJSON.message);
                }
            })

            return false;
        }

        @endif

        $(document).ready(function () {
            function image_slider_init() {
                $(document).on('click', '.image-slider-next', function () {
                    let margin_left = $('.image-slider-items').css('margin-left').replace(/px/, '');
                    let container_width = $('.image-slider-items').width();
                    let new_value;
                    let max_width = 0;

                    $('.image-slider-item').each(function () {
                        max_width += +$(this).width() + 1;
                    });

                    if (max_width - container_width <= Math.abs(margin_left) + container_width)
                        new_value = -(+max_width - container_width) + 'px';
                    else
                        new_value = -(Math.abs(margin_left) + container_width) + 'px';

                    $('.image-slider-items').animate({"margin-left": new_value}, 200);
                });

                $(document).on('click', '.image-slider-prev', function () {
                    let margin_left = $('.image-slider-items').css('margin-left').replace(/px/, '');
                    let container_width = $('.image-slider-items').width();
                    let new_value;

                    if (Math.abs(margin_left) - container_width < 0)
                        new_value = 0 + 'px';
                    else
                        new_value = -(Math.abs(margin_left) - container_width) + 'px';

                    $('.image-slider-items').animate({"margin-left": new_value}, 200);
                });

                $(document).on('click', '.image-slider-item', function () {
                    $('.main-image img').attr('src', $(this).data('src'));
                });
            }

            image_slider_init();

            $(document).on('submit', '#simple-buy-form', function (event) {
                event.preventDefault();

                let data = {};
                let form = $(this);

                data.name = form.find('[name="name"]').val();
                data.phone = form.find('[name="phone"]').val();
                data.id = form.find('[name="id"]').val();

                form.find('button').attr('disabled', 'disabled');

                $.ajax({
                    type: 'post',
                    data: data,
                    url: '{{ route('catalog.post', ['simple_orders', 'create']) }}',
                    dataType: 'json',
                    responseType: 'json',
                    success(answer) {
                        form.prepend(`<div id="simple-buy-message" class="alert alert-success">` + answer.message + `</div>`);
                        form.find('[name="name"]').val('');
                        form.find('[name="phone"]').val('');

                        setTimeout(function () {
                            $('#simple-buy').modal('hide');
                            $('#simple-buy-message').remove();
                            form.find('button').removeAttr('disabled');
                        }, 5000);
                    }
                });
            });

            function star($star, it) {

                $star.parents('.stars').find('.star').each(function () {
                    let $this = $(this);

                    if ($this.data('it') <= it) {
                        $this.find('img').attr('src', '{{ asset('catalog/img/star-active.png') }}');
                    } else {
                        $this.find('img').attr('src', '{{ asset('catalog/img/star-no-active.png') }}');
                    }
                });
            }

            $(document).on('mouseenter', '.star', function () {
                let $this = $(this);
                let it = $this.data('it');
                star($this, it);
            });

            $(document).on('mouseleave', '.star', function () {
                let $this = $(this);
                let it = $this.parents('.stars').data('it');
                star($this, it);
            });

            $(document).on('click', '.star', function () {
                let $this = $(this);
                let it = $this.data('it');
                $this.parent().data('it', it);
                star($this, it);
            });
        });
    </script>


    <script>
        $(document).on('click', '.manufacturer-next', function () {
            let margin_left = $('.manufacturer-items').css('margin-left').replace(/px/, '');
            let container_width = $('.manufacturer-items').width();
            let new_value;
            let max_width = 0;

            $('.manufacturer').each(function () {
                max_width += $(this).width();
            });

            if (max_width - container_width <= Math.abs(margin_left) + container_width)
                new_value = -(+max_width - container_width) + 'px';
            else
                new_value = -(Math.abs(margin_left) + container_width) + 'px';

            $('.manufacturer-items').animate({"margin-left": new_value}, 200);
        });

        $(document).on('click', '.manufacturer-prev', function () {
            let margin_left = $('.manufacturer-items').css('margin-left').replace(/px/, '');
            let container_width = $('.manufacturer-items').width();
            let new_value;

            if (Math.abs(margin_left) - container_width < 0)
                new_value = 0 + 'px';
            else
                new_value = -(Math.abs(margin_left) - container_width) + 'px';

            $('.manufacturer-items').animate({"margin-left": new_value}, 200);
        });

    </script>

@endsection