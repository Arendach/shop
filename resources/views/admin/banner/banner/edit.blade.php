@extends('admin.layout')

@section('style')
    <style>
        .uploadButton {
            display: block;
            width: 100%;
            background: #3df;
            padding: 10px;
            color: #FFF;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
        }

        .uploadButton:hover {
            background: #3ce;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-3">

            <form enctype="multipart/form-data">
                <div class="form-group">
                    <label for="selectBannerPhoto" class="uploadButton">@lang('banner.admin.select_image')</label>
                    <input style="display: none" type="file" id="selectBannerPhoto">
                </div>

                <div id="image-preview"></div>

                <div class="form-group">
                    <button id="uploadBannerPhoto" class="btn btn-primary">@lang('common.save')</button>
                </div>

                <div class="form-group">
                    <img id="imageView" src="{{ $image->image}}" alt="" width="100%">
                </div>
            </form>

        </div>
        <div class="col-9">
            <form data-type="ajax" data-url="{{ route('admin.post', ['banner', 'banner', 'update']) }}">
                <input type="hidden" name="id" value="{{ $image->id }}">
                <ul class="nav nav-tabs nav-justified" id="editBanner" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#uk">
                            <img src="{{ asset('img/uk.png') }}"> @lang('banner.admin.uk_desc')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ru">
                            <img src="{{ asset('img/ru.png') }}"> @lang('banner.admin.ru_desc')
                        </a>
                    </li>
                </ul>

                <br>

                <div class="tab-content" id="editBannerContent">
                    @foreach(config('locale.support') as $lang)
                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $lang }}">
                            <div class="form-group">
                                <label><i class="text-danger">*</i> @lang('banner.admin.title')</label>
                                <input class="form-control" name="title_{{ $lang }}"
                                       value="{{ $image->{"title_$lang"} }}">
                                <div class="feedback"></div>
                            </div>

                            <div class="form-group">
                                <label><i class="text-danger">*</i> @lang('banner.admin.url')</label>
                                <input class="form-control" name="url_{{ $lang }}"
                                       value="{{ $image->{"url_$lang"} }}">
                                <div class="feedback"></div>
                            </div>

                            <div class="form-group">
                                <label>@lang('banner.admin.alt')</label>
                                <input class="form-control" name="alt_{{ $lang }}" value="{{ $image->{"alt_$lang"} }}">
                                <div class="feedback"></div>
                            </div>

                            <div class="form-group">
                                <label>@lang('banner.admin.description')</label>
                                <textarea name="description_{{ $lang }}"
                                          class="form-control">{{ $image->{"description_$lang"} }}</textarea>
                                <div class="feedback"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>@lang('banner.admin.color')</label>
                    <input class="form-control" name="color" value="{{ $image->color }}">
                    <div class="feedback"></div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">@lang('common.save')</button>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('script')

    <script>
        $(document).ready(function () {
            let file = [];

            $(document).on('change', '#selectBannerPhoto', function () {
                let input = $(this)[0];

                if (input.files && input.files[0]) {
                    file = input.files[0];
                    if (file.type.match('image.*')) {
                        let reader = new FileReader();
                        reader.onload = function (e) {
                            $('#image-preview')
                                .addClass('form-group')
                                .html(`<img width="100%" src="${e.target.result}">`);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $(document).on('click', '#uploadBannerPhoto', function (event) {
                event.preventDefault();

                let data = new FormData();
                data.append('image', file);
                data.append('image_id', '{{ $image->id }}');

                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.post', ['banner', 'banner', 'image_upload']) }}',
                    processData: false,
                    contentType: false,
                    data: data,
                    success(answer) {
                        toastr.success(answer.message, 'Виконано!');
                        $('#imageView').attr('src', answer.path);
                        $('#image-preview').removeClass('form-group').html('');
                    },
                    error(answer) {
                        Common.errorHandler(answer);
                    }
                });
            });
        });
    </script>

@endsection