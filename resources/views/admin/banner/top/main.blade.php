@inject('banner', "App\\Services\\BannerService")

@extends('admin.layout')

@section('content')

    <form id="updateTopBanner">
        @if($banner->getPhoto() != '')
            <div class="form-group">
                <div id="photo_container">
                    <div style="background-color: {{ $banner->getColor() }}; text-align: center">
                        <img style="max-width: 100%" src="{{ asset($banner->getPhotoUrl()) }}">
                    </div>
                </div>
            </div>
        @else
            <div class="form-group">
                <div id="photo_container">
                    <i class="fa fa-photo"></i> no photo
                </div>
            </div>
        @endisset
        <div class="form-group">
            <label>@lang('banner.admin.photo')</label> <br>
            <label class="form-control" for="photo">Виберіть фото</label>
            <input id="photo" type="file" accept="image/*" style="display: none">
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.show_top_banner')</label>
            <select class="form-control" name="is_active">
                <option {{ !$banner->isActive() ? 'selected' : '' }} value="0">
                    @lang('banner.admin.no')
                </option>
                <option {{ $banner->isActive() ? 'selected' : '' }} value="1">
                    @lang('banner.admin.yes')
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.page_slug')</label>
            <input class="form-control" name="page" value="{{ $banner->getPage() }}">
            <div class="hints"></div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.background_color')</label>
            <input class="form-control" name="color" value="{{ $banner->getColor() }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">@lang('common.save')</button>
        </div>
    </form>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            let file = null;

            $(document).on('change', '#photo', function (event) {
                let input = $(this)[0];
                if (input.files && input.files[0]) {
                    file = input.files[0];
                    if (file.type.match('image.*')) {
                        let reader = new FileReader();
                        reader.onload = function (e) {
                            $('#photo_container').html('<img width="100%" src="' + e.target.result + '">');
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $(document).on('submit', '#updateTopBanner', function (event) {
                event.preventDefault();

                let data = new FormData();
                data.append('photo', file);
                data.append('color', $(this).find('[name=color]').val());
                data.append('page', $(this).find('[name=page]').val());
                data.append('is_active', $(this).find('[name=is_active]').val());

                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.post', ['banner', 'top', 'update']) }}',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (answer) {
                        toastr.success(answer.message, 'Виконано!');
                    },
                    error: function (answer) {
                        var text = '';
                        for (var i in answer.responseJSON.errors)
                            text += answer.responseJSON.errors[i].join('<br>') + '<br>';

                        toastr.options.escapeHtml = false;
                        toastr.error(text, 'Error!');
                    }
                });
            });

            $(document).on('keyup', '[name=page]', function () {
                let value = $(this).val();

                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.post', ['banner', 'top', 'hint']) }}',
                    data: {value},
                    success(answer) {
                        $('.hints').html(answer);
                    }
                });
            });

            $(document).on('click', '.hint', function () {
                $('[name=page]').val($(this).data('value'));
                $('.hints').html('');
            })
        });
    </script>

@endsection