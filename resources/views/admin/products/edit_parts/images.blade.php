<div class="right" style="margin-bottom: 15px">
    <button data-type="get_form"
            data-url="{{ route('admin.post', ['product', 'product_image', 'upload_form']) }}"
            data-post="{{ params(['id' => $product->id]) }}"
            class="btn btn-primary">
        Додати зображення
    </button>
</div>

@if($product->images->count())

    <table class="table table-bordered">
        <tr>
            <th>Зображення</th>
            <th>Альтернативний текст</th>
            <th>Пріоритет</th>
            <th style="width: 150px;text-align: center">Действия</th>
        </tr>
        @foreach($product->images as $item)
            <tr>
                <td><img src="{{ $item->small }}" height="150px"></td>
                <td>{{ $item->alt }}</td>
                <td>{{ $item->priority }}</td>
                <td style="width: 100px;text-align: center">
                    <button data-type="get_form"
                            data-url="{{ route('admin.post', ['product', 'product_image', 'update_form']) }}"
                            data-post="{{ params(['id' => $item->id]) }}"
                            class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-pencil"></i>
                    </button>

                    <button data-type="delete"
                            data-url="{{ route('admin.post', ['product', 'product_image', 'delete']) }}"
                            data-id="{{ $item->id }}"
                            class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-remove"></i>
                    </button>

                    @if($item->small == $product->small)
                        <button class="btn btn-primary btn-sm">
                            <i class="fa fa-check"></i>
                        </button>
                    @else
                        <button title="Зробити головним"
                                data-type="ajax_request"
                                data-url="{{ route('admin.post', ['product', 'product_image','change_main']) }}"
                                data-post="{{ params(['product_id' => $product->id, 'image_id' => $item->id]) }}"
                                class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-check"></i>
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@else
    <h4 class="centered">@lang('common.empty')</h4>
@endif
