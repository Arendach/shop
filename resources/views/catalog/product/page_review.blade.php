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
                        <h1>Write a review for {{ $name }}</h1>
                        <form id="review-form">
                            <div class="rating_submit">
                                <div class="form-group">
                                    <label class="d-block">Overall rating</label>
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
                                <label>Title of your review</label>
                                <input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?" name="title">
                            </div>
                            <div class="form-group">
                                <label>Your review</label>
                                <textarea class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business" name="text"></textarea>
                            </div>
                            <input type="hidden" value="{{ $id }}" name="product_id">
                            <a href="#" class="btn_1">Submit review</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#review-form').validate({
                rules: {
                    title: "required",
                    text: "required"
                },
                messages: {
                    title: "title is empty",
                    text: "text is empty"
                },
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "text-danger" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).addClass( "is-invalid" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).addClass( "has-success" ).removeClass( "is-invalid" );
                }
            });
        });

        $('.btn_1').on('click', function(){
            if ($("#review-form").valid()) {
                alert('Оставление отзыва');
            } else {
                alert('Не оставляем отзыв');
            }
        });
    </script>
@endsection