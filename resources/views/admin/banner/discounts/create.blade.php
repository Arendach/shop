@extends('admin.layout')

@section('content')

    <form id="create_discount">
        <div class="form-group">
            <label>@lang('banner.admin.page')</label>
            <input class="form-control" name="page">
            <div class="feedback"></div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.start')</label>
            <input type="date" class="form-control" name="start">
            <div class="feedback"></div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.finish')</label>
            <input type="date" class="form-control" name="finish">
            <div class="feedback"></div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.name')</label>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}" alt="">
                            </div>
                        </div>
                        <input class="form-control" name="name_uk">
                        <div class="feedback"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}" alt="">
                            </div>
                        </div>
                        <input class="form-control" name="name_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.image_min')</label>

            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}" alt="">
                            </div>
                        </div>
                        <label for="image_min_uk" class="form-control">@lang('banner.admin.select_image')</label>
                        <input accept="image/*" type="file" style="display: none" name="image_min_uk" id="image_min_uk">
                        <div class="feedback"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}" alt="">
                            </div>
                        </div>
                        <label for="image_min_ru" class="form-control">@lang('banner.admin.select_image')</label>
                        <input accept="image/*" type="file" style="display: none" name="image_min_ru" id="image_min_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.image_second')</label>

            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}" alt="">
                            </div>
                        </div>
                        <label for="image_second_uk" class="form-control">@lang('banner.admin.select_image')</label>
                        <input accept="image/*" type="file" style="display: none" name="image_second_uk" id="image_second_uk">
                        <div class="feedback"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}" alt="">
                            </div>
                        </div>
                        <label for="image_second_ru" class="form-control">@lang('banner.admin.select_image')</label>
                        <input accept="image/*" type="file" style="display: none" name="image_second_ru" id="image_second_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.image_max')</label>

            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}" alt="">
                            </div>
                        </div>
                        <label for="image_max_uk" class="form-control">@lang('banner.admin.select_image')</label>
                        <input accept="image/*" type="file" style="display: none" name="image_max_uk" id="image_max_uk">
                        <div class="feedback"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}" alt="">
                            </div>
                        </div>
                        <label for="image_max_ru" class="form-control">@lang('banner.admin.select_image')</label>
                        <input accept="image/*" type="file" style="display: none" name="image_max_ru" id="image_max_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">@lang('common.save')</button>
        </div>
    </form>

@endsection('content')