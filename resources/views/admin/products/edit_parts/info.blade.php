<style>
    .ck-editor__editable
    {
        min-height: 200px !important;
    }
</style>

<form data-type="ajax"
      data-url="{{ route('admin.post',['product', 'product', 'update']) }}"
      data-error-driver="toastr"
      data-after="close"
      data-success-driver="toastr">

    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('products.admin.category')</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $item)
                <option disabled>{{ $item->name }}</option>
                @foreach($item->child as $child)
                    <option {{ $child->id == $product->category_id ? 'selected' : '' }} value="{{ $child->id }}">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - {{ $child->name }}
                    </option>
                @endforeach
            @endforeach
        </select>

        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('products.admin.article')</label>
        <input class="form-control" name="article" value="{{ $product->article }}">
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('products.admin.price')</label>
        <input class="form-control" name="price" value="{{ $product->getOriginal('price') }}">
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label>@lang('products.admin.discount_price')</label>
        <input class="form-control" name="discount" value="{{ $product->getOriginal('discount') }}">
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('products.admin.on_storage')</label>
        <select class="form-control" name="on_storage">
            <option {{ !$product->on_storage ? 'selected' : '' }} value="0">
                @lang('banner.admin.no')
            </option>

            <option {{ $product->on_storage ? 'selected' : '' }} value="1">
                @lang('banner.admin.yes')
            </option>
        </select>
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label> @lang('products.admin.is_new')</label>
        <select class="form-control" name="is_new">
            <option {{ !$product->is_new ? 'selected' : '' }} value="0">
                @lang('banner.admin.no')
            </option>

            <option {{ $product->is_new ? 'selected' : '' }} value="1">
                @lang('banner.admin.yes')
            </option>
        </select>
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label>@lang('products.admin.is_recommended')</label>
        <select class="form-control" name="is_recommended">
            <option {{ !$product->is_recommended ? 'selected' : '' }} value="0">
                @lang('banner.admin.no')
            </option>

            <option {{ $product->is_recommended ? 'selected' : '' }} value="1">
                @lang('banner.admin.yes')
            </option>
        </select>
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> @lang('products.admin.name')</label>
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                    </div>
                    <input value="{{ $product->name_uk }}" name="name_uk" class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}">
                            </span>
                    </div>
                    <input value="{{ $product->name_ru }}" name="name_ru" class="form-control">
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>@lang('products.admin.slug')</label>
        <input class="form-control" value="{{ $product->slug }}" name="slug">
        <div class="feedback"></div>
        <div class="preview" data-pattern="{{ route('product.view', '%s%') }}" style="font-size: 14px;color: #ccc">
            {{ route('product.view', $product->slug) }}
        </div>
    </div>

    <div class="form-group">
        <label><img src="{{ asset('img/uk.png') }}">  @lang('banner.admin.uk_desc')</label>
        <textarea style="height: 200px" name="description_uk">{{ htmlspecialchars_decode($product->description_uk) }}</textarea>
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <label><img src="{{ asset('img/ru.png') }}"> @lang('banner.admin.ru_desc')</label>
        <textarea style="height: 200px" name="description_ru">{{ htmlspecialchars_decode($product->description_ru) }}</textarea>
        <div class="feedback"></div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary">@lang('common.save')</button>
    </div>
</form>

<script src="{{ asset('adm/js/ckeditor/ckeditor.js') }}"></script>

<script type="module">
    import slugify from '{{ asset('js/slugify.js') }}';

    $(document).on('keyup', '[name="name_{{ config('locale.default') }}"]', function () {
        let $slug = $('[name="slug"]');
        let $preview = $slug.parent().find('.preview');

        let name = slugify($(this).val());
        let pattern = $preview.data('pattern');

        let url = pattern.replace('%s%', name);

        $slug.val(name);
        $preview.html(url);
    });

    $(document).on('keyup', '[name="slug"]', function () {
        let $this = $(this);
        let $preview = $this.parent().find('.preview');

        let pattern = $preview.data('pattern');

        $preview.html(pattern.replace('%s%', $this.val()));
    });

    $(document).ready(function () {
        CKEDITOR.replace('description_uk');
        CKEDITOR.replace('description_ru');
    });
</script>