@extends('admin.modal')

@section('content')

    <form data-type="ajax"
          data-url="{{ route('admin.post', ['category', 'link', 'create']) }}"
          data-after="reload"
          data-error-driver="toastr"
          data-success-driver="sweetalert">
        <input type="hidden" name="category_id" value="{{ $category_id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> @lang('category.admin.name')</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input class="form-control" name="name_uk">
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
                        <input class="form-control" name="name_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> @lang('category.admin.url')</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input class="form-control" name="url_uk">
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
                        <input class="form-control" name="url_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mb-0">
            <button class="btn btn-primary">@lang('common.save')</button>
        </div>
    </form>

@endsection('content')