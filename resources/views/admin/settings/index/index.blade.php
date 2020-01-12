<form action="{{ route('admin.post', ['settings', 'index', 'update']) }}">
    <div class="form-group">
        <label></label>
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <img src="{{ asset(config('default.image.uk')) }}" alt="">
                    </span>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group"></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label></label>
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <img src="{{ asset(config('default.image.uk')) }}" alt="">
                    </span>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group"></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label></label>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <img src="{{ asset(config('default.image.uk')) }}">
                        </span>
                    </div>
                    <input class="form-control" name="title_uk">
                    <div class="feedback"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <img src="{{ asset(config('default.image.ru')) }}">
                        </span>
                    </div>
                    <input class="form-control" name="title_ru" value="{{ Settings::get('index_title_ru') }}">
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label></label>
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <img src="{{ asset(config('default.image.uk')) }}" alt="">
                    </span>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group"></div>
            </div>
        </div>
    </div>

    <div class="form-group">

    </div>
</form>