@extends('admin.layout')

@section('content')

    <form data-type="ajax"
          data-url="{{ route('admin.post', ['category', 'category', 'create']) }}"
          data-after="redirect"
          data-success-driver="sweetalert"
          data-error-driver="toastr">
        <div class="form-group">
            <label><i class="text-danger">*</i> @lang('category.admin.parent')</label>
            <select name="parent_id" class="form-control">
                <option value="0">@lang('category.admin.root')</option>
                @foreach($root_categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <div class="feedback"></div>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> @lang('banner.admin.name')</label>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input name="name_uk" class="form-control">
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
                        <input name="name_ru" class="form-control">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('banner.admin.description')</label>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input name="description_uk" class="form-control">
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
                        <input name="description_ru" class="form-control">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('common.seo.title')</label>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input name="meta_title_uk" class="form-control">
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
                        <input name="meta_title_ru" class="form-control">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('common.seo.keywords')</label>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input name="meta_keywords_uk" class="form-control">
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
                        <input name="meta_keywords_ru" class="form-control">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>@lang('common.seo.description')</label>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input name="meta_description_uk" class="form-control">
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
                        <input name="meta_description_ru" class="form-control">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Сектор URL</label>
            <input class="form-control" name="slug" value="" pattern="[a-z0-9\-]+" required>
            <div class="feedback"></div>
            <div class="preview" data-pattern="{{ route('category.show', '%s%') }}"
                 style="font-size: 14px; color: #ccc">
                {{ route('category.show', '') }}
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">@lang('common.save')</button>
        </div>
    </form>


@endsection

@section('script')
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
    </script>
@endsection
