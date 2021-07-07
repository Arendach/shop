<main style="margin-top: -1.8%;">
    <div class="container mt-0">
        <div class="row mt-0">
            @if($questions->count())
                <div class="col-md-12 p-3" itemscope itemtype="https://schema.org/FAQPage">
                    @foreach($questions as $i => $question)
                        <div class="faq-card">
                            <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                <div class="faq-card-header" data-id="faq-card-body-{{ $i }}">
                                    <h3 itemprop="name"> {{ $question->question }}</h3>
                                    <span class="faq-card-arrow-icon">
                                        <svg viewBox="0 0 512 512" height="14px" width="10px">
                                            <path d="M400.7 478.5L367.2 512l-256-256 256-256 33.5 33.5-222.5 222.6 222.5 222.4z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div id="faq-card-body-{{ $i }}" class="faq-card-body">
                                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div itemprop="text">{!! $question->answer !!}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

</main>