@extends('catalog.modal')

@section('content')
    <form id="update_review_comment">
        <div class="form-group">
            <div class="alert alert-info">
                {{ $comment->comment }}
            </div>
        </div>

        <div class="form-group">
            <label for="comment">Коментар:</label>
            <textarea id="comment" name="comment" class="form-control">{{ $comment->comment }}</textarea>
            <div class="feedback"></div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <button class="btn btn-outline-primary">Зберегти</button>
        </div>
    </form>

    <script>
        $(document).on('submit', '#update_review_comment', function (event) {
            event.preventDefault();

            let comment = $(this).find('[name="comment"]').val();

            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['product', 'review_comment_update']) }}',
                data: {
                    id: '{{ $comment->id }}',
                    comment
                },
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
                            $('#review-comment-{{ $comment->id }}').find('.review-comment-text').html(comment);
                            $('#modal').remove();
                        }, 300);
                    });
                },
                error(answer) {
                    toastr.error(answer.responseJSON.message, answer.responseJSON.title);

                    let $comment = $('[name="comment"]');

                    $comment.addClass('is-invalid');

                    if('comment' in answer.responseJSON.errors)
                        $comment.parent().find('.feedback').addClass('invalid-feedback').html(answer.responseJSON.errors.comment);
                }
            })
        });

        $(document).on('keyup', '[name="comment"]', function () {
            $(this).removeClass('is-invalid');
            $(this).parent().find('.feedback').removeClass('invalid-feedback').html('');
        });
    </script>
@endsection