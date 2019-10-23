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

    <form id="createBanner" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="selectBannerPhoto" class="uploadButton">@lang('banner.admin.select_image')</label>
                    <input style="display: none" accept="image/*" type="file" id="selectBannerPhoto">
                </div>

                <div id="image-preview"></div>
            </div>
            <div class="col-9">
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
                                <input class="form-control" name="title_{{ $lang }}">
                                <div class="feedback"></div>
                            </div>

                            <div class="form-group">
                                <label><i class="text-danger">*</i> @lang('banner.admin.url')</label>
                                <input class="form-control" name="url_{{ $lang }}">
                                <div class="feedback"></div>
                            </div>

                            <div class="form-group">
                                <label>@lang('banner.admin.alt')</label>
                                <input class="form-control" name="alt_{{ $lang }}">
                                <div class="feedback"></div>
                            </div>

                            <div class="form-group">
                                <label>@lang('banner.admin.description')</label>
                                <textarea name="description_{{ $lang }}" class="form-control"></textarea>
                                <div class="feedback"></div>
                            </div>
                        </div>
                    @endforeach

                        <div class="form-group">
                            <label>@lang('banner.admin.color')</label>
                            <input class="form-control" name="color" value="#fff">
                            <div class="feedback"></div>
                        </div>

                    <div class="form-group">
                        <button class="btn btn-primary">@lang('common.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')

    <script>
        $(document).ready(function () {

            let file = null;

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

            $(document).on('submit', '#createBanner', function (event) {
                event.preventDefault();

                if (file === null)
                    return toastr.error('@lang('banner.admin.validation.file_not_selected')', '@lang('common.error')');

                let data = new FormData();
                let form = $(this).serializeJSON();

                for (let i in form)
                    data.append(i, form[i]);

                data.append('image', file);

                Common.disableForm('#createBanner');

                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.post', ['banner', 'banner', 'store']) }}',
                    data,
                    processData: false,
                    contentType: false,
                    success(answer) {
                        swal({
                            type: 'success',
                            title: answer.title,
                            text: answer.text,
                            html: true,
                            closeOnCancel: false,
                        }, function () {
                            window.location.href = answer.routeRedirect;
                        });
                    },
                    error(answer) {
                        Common.enableForm('#createBanner');
                        Common.appendErrors(answer.responseJSON.errors);
                        Common.errorHandler(answer);
                    }
                });
            });
        });
    </script>

@endsection