<form id="create_review">
    <div class="form-group">
        <label for="comment">Коментар</label>
        <textarea name="comment" class="form-control"></textarea>
    </div>
    <div class="form-group" style="margin-bottom: 0;">
        <button class="btn btn-outline-primary">Надіслати</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $(document).on('submit', '#create_review', function (event) {
            event.preventDefault();

            let $this = $(this);
            let comment = $this.find('[name="comment"]').val();
            let review_id = '{{ $review->id }}';

            $.ajax({
                type: 'post',
                url: '{{ route('catalog.post', ['product', 'create_review_comment']) }}',
                data: {comment, review_id},
                success(answer) {
                    let parent = $('#review-{{ $review->id }}');
                    parent.find('.review-comments').append(answer);
                    parent.find('.review-answer-place').html('');

                    toastr.success('Ваше повідомлення прийняте!', 'Виконано!');
                },
                error(answer) {
                    Common.errorHandler(answer);
                }
            })
        });
    });
</script>