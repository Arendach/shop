@extends('catalog.modal')

@section('content')
    <form id="update_review">
        <input type="hidden" name="id" value="{{ $review->id }}">
        <div class="form-group">
            <label>Ваша оцінка</label>
            <div class="stars" data-it="{{ $review->rating }}">
                @for($i = 1; $i <= 5; $i++)
                    <span class="star" data-it="{{ $i }}">
                        @if($review->rating >= $i)
                            <img id="star-{{ $i }}" src="{{ asset('catalog/img/star-active.png') }}">
                        @else
                            <img id="star-{{ $i }}" src="{{ asset('catalog/img/star-no-active.png') }}">
                        @endif
                    </span>

                @endfor
            </div>
        </div>

        <div class="form-group">
            <label for="plus">Достоїнства товару</label>
            <input name="plus" class="form-control" value="{{ $review->plus }}">
        </div>

        <div class="form-group">
            <label for="minus">Недоліки товару</label>
            <input name="minus" class="form-control" value="{{ $review->minus }}">
        </div>

        <div class="form-group">
            <label for="comment">Коментар</label>
            <textarea name="comment" class="form-control">{{ $review->comment }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <button class="btn btn-outline-primary">Зберегти</button>
        </div>
    </form>

    <script>
        $(document).on('submit', '#update_review', function (event) {
            event.preventDefault();
            let $this = $(this);

            let data = $this.serializeJSON();

            data.rating = $this.find('.stars').data('it');

            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['product', 'review_update']) }}',
                data,
                success(answer) {
                    $('body').append(answer);
                    $('#modal').modal('hide');

                    swal({
                        type: 'success',
                        title: answer.title,
                        text: answer.message,
                        closeOnConfirm: false
                    }, function () {
                        swal.close();

                        setTimeout(function () {
                            $('#review-{{ $review->id }}').find('.review-comment-text span').html(data.comment);
                            $('#review-{{ $review->id }}').find('.review-plus span').html(data.plus);
                            $('#review-{{ $review->id }}').find('.review-minus span').html(data.minus);
                            $('#modal').remove();

                            $('#review-{{ $review->id }}').find('.review-rating span').each(function (index) {
                                if (+index + 1 <= +data.rating)
                                    $(this).find('img').attr('src', '{{ asset('catalog/img/star-active.png') }}');
                                else
                                    $(this).find('img').attr('src', '{{ asset('catalog/img/star-no-active.png') }}');
                            });
                        }, 300);
                    });
                },
                error(answer) {
                    toastr.error(answer.responseJSON.message, answer.responseJSON.title);

                    let errors = answer.responseJSON.errors;

                    for (let field in errors) {
                        let $element = $('[name="' + field + '"]');

                        $element.addClass('is-invalid');

                        $element.parent().find('.feedback').addClass('invalid-feedback').html(errors[field]);
                    }
                }
            })
        });

        $(document).on('keyup', '.form-control', function () {
            $(this).removeClass('is-invalid');
            $(this).parent().find('.feedback').removeClass('invalid-feedback').html('');
        });
    </script>
@endsection