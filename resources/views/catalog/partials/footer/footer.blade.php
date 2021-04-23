<footer class="revealed" style="background-color: {{ setting('колір футера сайта','#172134') }}; color:{{ setting('колір тексту футера сайта','white') }};">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 style="color:{{ setting('колір тексту футера сайта','white') }};" data-target="#collapse_1">@translate('Швидка навігація')</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        @foreach($fastNavigation as $page)
                            <li>
                                <a style="color:{{ setting('колір тексту футера сайта','white') }};" href="{{ $page->url }}">
                                    {{ $page->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 style="color:{{ setting('колір тексту футера сайта','white') }};" data-target="#collapse_2">@translate('Категорії')</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        @foreach($categories->slice(0, 10)->all() as $category)
                            <li><a style="color:{{ setting('колір тексту футера сайта','white') }};" href="{{ $category->url }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_3" style="color:{{ setting('колір тексту футера сайта','white') }};">@translate('Контакти')</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li style="color:{{ setting('колір тексту футера сайта','white') }};"><i class="ti-home" style="color:{{ setting('колір тексту футера сайта','white') }};"></i>{!! $globalData->footer_address !!}</li>
                        <li style="color:{{ setting('колір тексту футера сайта','white') }};"><i class="ti-headphone-alt" style="color:{{ setting('колір тексту футера сайта','white') }};"></i>{{ $globalData->formatPhone('footer_phone') }}</li>
                        <li><i class="ti-email" style="color:{{ setting('колір тексту футера сайта','white') }};"></i><a style="color:{{ setting('колір тексту футера сайта','white') }};" href="#0">{{ $globalData->footer_email }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_4" style="color:{{ setting('колір тексту футера сайта','white') }};">@translate('Підписатись на знижки')</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div class="form-group" style="color:{{ setting('колір тексту футера сайта','white') }};">
                            <input type="email"
                                   name="email_newsletter"
                                   id="email_newsletter"
                                   class="form-control"
                                   placeholder="@translate('Ваша електрона пошта')"
                            />
                            <button type="submit" id="submit-newsletter">
                                <i class="ti-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="follow_us">
                        <h5 style="color:{{ setting('колір тексту футера сайта','white') }};">@editable('Підпишіться на нас')</h5>
                        <ul>
                            <li>
                                <a href="{{ setting('Посилання на facebook', 'https://facebook.com/vozdushno.com.ua') }}">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                         data-src="{{ asset('catalog/img/facebook_icon.svg') }}" class="lazy">
                                </a>
                            </li>
                            <li>
                                <a href="{{ setting('Посилання на instagram', 'http://instagram.com/vozdushno') }}">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                         data-src="{{ asset('catalog/img/instagram_icon.svg') }}" class="lazy">
                                </a>
                            </li>
                            <li>
                                <a href="{{ setting('Посилання на youtube', 'https://www.youtube.com/channel/UCgetz4SbavYicHpsz0X9u1A') }}">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                         data-src="{{ asset('catalog/img/youtube_icon.svg') }}" class="lazy">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
{{--                    <li>
                                            <div class="styled-select lang-selector">
                                                <select onchange="window.location.href = this.value">
                                                    <option {{ config('locale.current') == "uk" ? 'selected': '' }} value="{{ route('locale', 'uk') }}">
                                                        @translate('Українська')
                                                    </option>
                                                    <option {{ config('locale.current') == "ru" ? 'selected': '' }} value="{{ route('locale', 'ru') }}">
                                                        @translate('Російська')
                                                    </option>
                                                </select>
                                            </div>
                                        </li>
                    --}}                    <li>
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                             data-src="{{ asset('catalog/img/cards_all.svg') }}" alt="" width="198" height="30"
                             class="lazy"></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a style="color:{{ setting('колір тексту футера сайта','white') }};" href="{{ url('page/terms') }}">{{ translate('Умови погодження') }}</a></li>
                    <li><a style="color:{{ setting('колір тексту футера сайта','white') }};" href="{{ url('page/about') }}">{{ translate('Про Нас') }}</a></li>
                    <li><span style="color:{{ setting('колір тексту футера сайта','white') }};">©{{ date('Y') }} {{ $globalData->copyright }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>