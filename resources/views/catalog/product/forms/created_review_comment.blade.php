{{--
<div class="review-comment">
    <span class="review-user">{{ $comment->user->name }}</span>
    ●
    <span class="review-date">{{ $comment->created_at->diffForHumans() }}</span>

    <div class="review-comment-text">{{ $comment->comment }}</div>
</div>

--}}

<div class="review-comment" id="review-comment-{{ $comment->id }}">
    <span class="review-user">{{ $comment->user->name }}</span>
    ●
    <span class="review-date">{{ $comment->created_at->diffForHumans() }}</span>

    @if(access('product') || user()->id == $comment->user->id)
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