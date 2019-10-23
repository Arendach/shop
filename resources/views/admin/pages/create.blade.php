@extends('admin.layout')

@section('content')

    <form data-url="{{ route('pages.store') }}" data-type="ajax">
        <div class="form-group">
            <label><i class="text-danger">*</i> @lang('pages.name')</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                        </div>
                        <input name="name_uk" class="form-control">
                        <div class="feedback"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}">
                            </span>
                        </div>
                        <input name="name_ru" class="form-control">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('common.seo.title')</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                        </div>
                        <input name="meta_title_uk" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}">
                            </span>
                        </div>
                        <input name="meta_title_ru" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('common.seo.description')</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                        </div>
                        <input name="meta_description_uk" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}">
                            </span>
                        </div>
                        <input name="meta_description_ru" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('common.seo.keywords')</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                        </div>
                        <input name="meta_keywords_uk" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}">
                            </span>
                        </div>
                        <input name="meta_keywords_ru" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> @lang('pages.content')</label>
            <div class="row">
                <div class="col-md-6">
                    <textarea name="content_uk"></textarea>
                </div>

                <div class="col-md-6">
                    <textarea name="content_ru"></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> @lang('pages.uri_name')</label>
            <input name="uri_name" class="form-control">
            <div class="feedback"></div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">@lang('common.save')</button>
        </div>
    </form>

@endsection('content')