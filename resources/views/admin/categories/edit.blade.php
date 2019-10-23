@extends('admin.layout')

@section('content')

    <ul class="nav nav-pills nav-justified mb">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#info">@lang('category.admin.info')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#photo">@lang('category.admin.photo')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#links">@lang('category.admin.links')</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="info">
            <form data-type="ajax"
                  data-url="{{ route('admin.post', ['category', 'category', 'update']) }}"
                  data-success-driver="toastr"
                  data-error-driver="toastr">
                <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="form-group">
                    <label><i class="text-danger">*</i> @lang('category.admin.parent')</label>
                    <select name="parent_id" class="form-control">
                        <option {{ $category->parent_id == 0 ? 'selected' : '' }} value="0">
                            @lang('category.admin.root')
                        </option>
                        @foreach($root_categories as $item)
                            @continue($item->id == $category->id)
                            <option {{ $item->id == $category->parent_id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
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
                                <input value="{{ $category->name_uk }}" name="name_uk" class="form-control">
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
                                <input value="{{ $category->name_ru }}" name="name_ru" class="form-control">
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
                                <input value="{{ $category->description_uk }}" name="description_uk"
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
                                <input value="{{ $category->description_ru }}" name="description_ru"
                                       class="form-control">
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
                                <input value="{{ $category->meta_title_uk }}" name="meta_title_uk" class="form-control">
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
                                <input value="{{ $category->meta_title_ru }}" name="meta_title_ru" class="form-control">
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
                                <input value="{{ $category->meta_keywords_uk }}" name="meta_keywords_uk"
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
                                <input value="{{ $category->meta_keywords_ru }}" name="meta_keywords_ru"
                                       class="form-control">
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
                                <input value="{{ $category->meta_description_uk }}" name="meta_description_uk"
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
                                <input value="{{ $category->meta_description_ru }}" name="meta_description_ru"
                                       class="form-control">
                                <div class="feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Сектор URL</label>
                    <input class="form-control" name="slug" value="{{ $category->slug }}" pattern="[a-z0-9\-]+"
                           required>
                    <div class="feedback"></div>
                    <div class="preview" data-pattern="{{ route('category.show', '%s%') }}"
                         style="font-size: 14px; color: #ccc">
                        {{ route('category.show', $category->slug) }}
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">@lang('common.save')</button>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="photo">

            <div class="row">
                <div class="col-3">
                    <img width="100%" src="{{ $category->big_image }}" alt="">
                </div>

                <div class="col-9">
                    <form action="{{ route('admin.post', ['category', 'category', 'update_image']) }}" method="post"
                          enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="form-group">
                            <label for="image">Виберіть фото</label> <br>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-primary">Завантажити</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="links">

            <div class="right mb">
                <button data-type="get_form"
                        data-url="{{ route('admin.post', ['category', 'link', 'create_form']) }}"
                        data-post="{{ params(['category_id' => $category->id]) }}"
                        class="btn btn-outline-success">
                    @lang('category.admin.new_link')
                </button>
            </div>

            @if($category->links->count())
                <table class="table table-bordered">
                    <tr>
                        <th>@lang('category.admin.name')</th>
                        <th>@lang('category.admin.url')</th>
                        <th class="action2">@lang('common.actions')</th>
                    </tr>
                    @foreach($category->links as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td><a href="{{ url($item->url) }}">{{ $item->url }}</a></td>
                            <td class="action2">
                                <button data-type="get_form"
                                        data-url="{{ route('admin.post', ['category', 'link', 'update_form']) }}"
                                        data-post="{{ params(['id' => $item->id]) }}"
                                        title="@lang('common.edit')"
                                        class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </button>

                                <button data-type="delete"
                                        data-url="{{ route('admin.post', ['category', 'link', 'delete']) }}"
                                        data-id="{{ $item->id }}"
                                        data-after="remove"
                                        title="@lang('common.del')"
                                        class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
                
                @else
                
                <h4 class="centered">@lang('common.empty')</h4>
                
            @endif
        </div>
    </div>

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
