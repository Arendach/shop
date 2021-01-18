<div id="feedbacks">
    <div id="feedback-contacts">
        <div class="feedback-item telegram-feedback">
            <a href="https://t.me/{{@setting('feedback_telegram', '#')}}" target="_blank">
                <img src="{{ asset('img/telegram.svg') }}">
            </a>
        </div>
        <div class="feedback-item whatsapp-feedback">
            <a href="https://wa.me/{{@setting('feedback_whatsapp', '#')}}" target="_blank">
                <img src="{{ asset('img/whatsapp.svg') }}">
            </a>
        </div>
        <div class="feedback-item viber-feedback">
            <a href="viber://{{ $agent->isMobile() ? 'add' : 'chat' }}?number={{ setting('feedback_viber', '#') }}" target="_blank">
                <img src="{{ asset('img/viber.svg') }}">
            </a>
        </div>
        <div class="feedback-item phone-feedback">
            <a href="tel:{{ setting('feedback_phone', '#') }}" target="_blank">
                <img src="{{ asset('img/phone.svg') }}">
            </a>
        </div>
        <div class="feedback-item email-feedback">
            <a href="mailto:{{ setting('feedback_email', '#') }}" target="_blank">
                <img src="{{ asset('img/email.svg') }}">
            </a>
        </div>
    </div>
    <div class="feedback-item menu-feedback">
        <a data-toggle="collapse" href="#feedback-contacts" role="button" aria-expanded="false" aria-controls="feedback-contacts">
            <img src="{{ asset('img/comment.svg') }}">
        </a>
    </div>
</div>
