<form data-type="ajax"
      data-url="{{ route('admin.post', ['product', 'product', 'update_seo']) }}"
      data-after="close"
      data-success-driver="toastr"
      data-error-driver="toastr">
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('common.seo.title')</label>
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                    </div>
                    <input value="{{ $product->meta_title_uk }}" name="meta_title_uk" class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.ru')) }}">
                            </span>
                    </div>
                    <input value="{{ $product->meta_title_ru }}" name="meta_title_ru" class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('common.seo.keywords')</label>
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                    </div>
                    <input value="{{ $product->meta_keywords_uk }}" name="meta_keywords_uk"
                           class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.ru')) }}">
                            </span>
                    </div>
                    <input value="{{ $product->meta_keywords_ru }}" name="meta_keywords_ru"
                           class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('common.seo.description')</label>
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                    </div>
                    <input value="{{ $product->meta_description_uk }}" name="meta_description_uk"
                           class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.ru')) }}">
                            </span>
                    </div>
                    <input value="{{ $product->meta_description_ru }}" name="meta_description_ru"
                           class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <button class="btn btn-primary">@lang('common.save')</button>
    </div>
</form>