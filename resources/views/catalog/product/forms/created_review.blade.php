<div class="review">
    <span class="review-user">{{ $review->user->name }}</span>
    ●
    <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
    @if($review->rating != 0)
        <div class="review-rating">
            @for($i = 1; $i <= 5; $i++)
                <span>
                    @if($i <= $review->rating)
                        <img src="{{ asset('catalog/img/star-active.png') }}">
                    @else
                        <img src="{{ asset('catalog/img/star-no-active.png') }}">
                    @endif
                </span>
            @endfor
        </div>
    @endif
    <div class="review-comment-text">{{ $review->comment }}</div>
    <div class="review-answer">
        <div class="row">
            <div class="col-6">
                <a data-id="{{ $review->id }}" class="review-answer-button" href="#">
                    Відповісти
                </a>
                <div class="review-answer-place"></div>
            </div>
            <div class="col-6 right">
                <a href="#" class="review-thumb review-thumb-up">
                    <i class="fa fa-thumbs-o-up"></i>
                </a> |
                <a href="#" class="review-thumb review-thumb-down">
                    <i class="fa fa-thumbs-o-down"></i>
                </a>
            </div>
        </div>

    </div>
    <div class="review-comments"></div>

</div>