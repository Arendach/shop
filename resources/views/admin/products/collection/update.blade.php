@extends('admin.layout')

@section('content')

    <nav>
        <div class="nav nav-pills nav-justified">
            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-home">Основне</a>
            <a class="nav-item nav-link" data-toggle="tab" href="#nav-profile">Фото</a>
            <a class="nav-item nav-link" data-toggle="tab" href="#nav-contact">Сео</a>
            @if($collection->parent_id != 0)
                <a class="nav-item nav-link" data-toggle="tab" href="#nav-products">Товари</a>
            @endif
        </div>
    </nav>

    <hr>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home">
            <form data-type="ajax"
                  data-after="close"
                  data-success-driver="toastr"
                  data-error-driver="toastr"
                  data-url="{{ route('admin.post', ['product', 'collection', 'update_info']) }}">
                <input type="hidden" name="id" value="{{ $collection->id }}">
                <div class="form-group">
                    <label><i class="text-danger">*</i> Назва</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset(config('default.image.uk')) }}">
                                    </span>
                                </div>
                                <input value="{{ $collection->name_uk }}" name="name_uk" class="form-control">
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
                                <input value="{{ $collection->name_ru }}" name="name_ru" class="form-control">
                                <div class="feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Псевдонім</label>
                    <input class="form-control" name="slug" value="{{ $collection->slug }}">
                    <div class="feedback"></div>
                </div>

                @if($collection->parent_id != 0)
                    <div class="form-group">
                        <label><i class="text-danger">*</i> Батьківська колекція</label>
                        <select name="parent_id" class="form-control">
                            @foreach($collections as $item)
                                <option {{ $collection->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="feedback"></div>
                    </div>
                @endif

                <div class="form-group">
                    <button class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="nav-profile">
            <div class="row">
                <div class="col-3">
                    <img src="{{ $collection->image }}" width="100%">
                </div>

                <div class="col-6">
                    <form id="update-image"
                          action="{{ route('admin.post', ['product', 'collection', 'update_image']) }}">
                        <input type="hidden" name="id" value="{{ $collection->id }}">

                        <div class="form-group">
                            <label>Виберіть фото(350х150)</label>
                            <input type="file" name="image" class="form-control">
                            <div class="feedback"></div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-contact">
            <form data-type="ajax"
                  data-after="close"
                  data-success-driver="toastr"
                  data-error-driver="toastr"
                  data-url="{{ route('admin.post', ['product', 'collection', 'update_seo']) }}">
                <input type="hidden" name="id" value="{{ $collection->id }}">
                <div class="form-group">
                    <label> <i class="text-danger">*</i> Заголовок(title)</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset(config('default.image.uk')) }}">
                                    </span>
                                </div>
                                <input value="{{ $collection->meta_title_uk }}" name="meta_title_uk"
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
                                <input value="{{ $collection->meta_title_ru }}" name="meta_title_ru"
                                       class="form-control">
                                <div class="feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ключові слова(Meta keywords)</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset(config('default.image.uk')) }}">
                                    </span>
                                </div>
                                <input value="{{ $collection->meta_keywords_uk }}" name="meta_keywords_uk"
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
                                <input value="{{ $collection->meta_keywords_ru }}" name="meta_keywords_ru"
                                       class="form-control">
                                <div class="feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Опис(Meta description)</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset(config('default.image.uk')) }}">
                                    </span>
                                </div>
                                <input value="{{ $collection->meta_description_uk }}" name="meta_description_uk"
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
                                <input value="{{ $collection->meta_description_ru }}" name="meta_description_ru"
                                       class="form-control">
                                <div class="feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>

        @if($collection->parent_id != 0)
            <div class="tab-pane fade" id="nav-products">

                <div style="margin-bottom: 15px;background-color: #eee; padding: 10px;">
                    <div class="form-group">
                        <input id="product-search" class="form-control" placeholder="Введіть назву або артикул">
                    </div>

                    <div id="place-result"></div>

                    <div class="form-group mb-0">
                        <button id="attach-products" class="btn btn-primary">Додати товари</button>
                    </div>
                </div>

                <table class="table table-bordered">

                    <tr>
                        <td colspan="2">Товар</td>
                        <td>Категорія товару</td>
                        <td style="width: 50px">Дії</td>
                    </tr>

                    @forelse($collection->items as $item)
                        <tr>
                            <td>
                                <a href="{{ route('product.view', $item->slug) }}">
                                    <img src="{{ $item->small_image }}" height="100px">
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('product.view', $item->slug) }}">
                                    {{ $item->name }}
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('category.show', $item->category->slug) }}">
                                    {{ $item->category->name }}
                                </a>
                            </td>

                            <td style="width: 50px">
                                <button data-type="delete"
                                        data-url="{{ route('admin.post', ['product', 'collection', 'detach_product']) }}"
                                        data-post="{{ params([
                                        'collection_id' => $collection->id,
                                        'product_id' => $item->id
                                    ]) }}"
                                        class="btn btn-sm btn-danger">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </td>
                        </tr>
                    @empty

                    @endforelse

                </table>

            </div>
        @endif
    </div>

@stop

@section('script')

    <script type="module">
        import CommonClass from '{{ asset('adm/js/classes/common.class.js') }}';

        const Common = new CommonClass();


        $(document).on('keyup', '#product-search', function () {
            let $this = $(this);

            $.ajax({
                type: 'post',
                url: '{{ route('admin.post', ['product', 'collection', 'search_products']) }}',
                data: {
                    field: $this.val(),
                    collection_id: '{{ $collection->id }}'
                },
                success(answer) {
                    $('#place-result').html(answer.content);
                },
                error(answer) {
                    Common.errorHandler(answer);
                }

            });
        });

        $(document).on('click', '#attach-products', function () {
            let ids = Elements.select('.select').getMultiSelected();

            if (ids.length == 0) return alert('Виберіть товари!');

            $.ajax({
                type: 'post',
                url: '{{ route('admin.post', ['product', 'collection', 'attach_products']) }}',
                data: {
                    collection_id: '{{ $collection->id }}',
                    ids
                },
                success(answer) {
                    Common.setAfter('reload');
                    Common.setSuccessDriver('sweetalert');
                    Common.successHandler(answer);
                },
                error(answer) {
                    Common.setSuccessDriver('sweetalert');
                    Common.errorHandler(answer);
                }

            })
        });

        $(document).on('submit', '#update-image', function (event) {
            event.preventDefault();

            let data = new FormData(this);

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data,
                cache: false,
                contentType: false,
                processData: false,
                success: (answer) => {
                    Common.setAfter('reload').setSuccessDriver('sweetalert').successHandler(answer);
                },
                error(answer) {
                    Common
                        .setErrorDriver('toastr')
                        .appendErrors(answer.responseJSON.errors)
                        .errorHandler(answer);
                }
            });
        });
    </script>

@stop