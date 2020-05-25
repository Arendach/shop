@extends('catalog.layout')

@section('css')
    <link href="{{ vAsset('catalog/css/leave_review.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
        <div class="container margin_60_35">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="write_review">
                        <h1>@translate('Відгуки до товару') {{ $product->name }}</h1>
                        <form id="review-form">
                            <div class="rating_submit">
                                <div class="form-group">
                                    <label class="d-block">@translate('Середній рейтинг')</label>
                                <span class="rating mb-0">
                                    <input type="radio" class="rating-input" id="5_star" name="rating-input" value="5 Stars"><label for="5_star" class="rating-star"></label>
                                    <input type="radio" class="rating-input" id="4_star" name="rating-input" value="4 Stars"><label for="4_star" class="rating-star"></label>
                                    <input type="radio" class="rating-input" id="3_star" name="rating-input" value="3 Stars"><label for="3_star" class="rating-star"></label>
                                    <input type="radio" class="rating-input" id="2_star" name="rating-input" value="2 Stars"><label for="2_star" class="rating-star"></label>
                                    <input type="radio" class="rating-input" id="1_star" name="rating-input" value="1 Star"><label for="1_star" class="rating-star"></label>
                                </span>
                                </div>
                            </div>
                            <!-- /rating_submit -->
                            <div class="form-group">
                                <label>@translate('Коротко')</label>
                                <input class="form-control" placeholder="@translate('Опишіть коротко ваші враження про товар')" name="title">
                            </div>
                            <div class="form-group">
                                <label>@translate('Ваш відгук')</label>
                                <textarea class="form-control" style="height: 180px;" placeholder="@translate('Опишіть в повній мірі ваші враження про товар')" name="comment"></textarea>
                            </div>
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <a href="#" class="btn_1">
                                @translate('Залишити відгук')
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/reviews.js') }}"> </script>
@endsection