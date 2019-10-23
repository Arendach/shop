<div style="margin-bottom: 15px;" class="right">
    <button data-type="get_form"
            data-url="{{ route('admin.post', ['product', 'product_characteristics', 'create_form']) }}"
            data-post="{{ params(['product_id' => $product->id])  }}"
            class="btn btn-primary">
        Нова характеристика
    </button>
</div>

@if($product->characteristics->count() > 0)
    <table class="table table-bordered">
        <tr>
            <td>Назва</td>
            <td>Значення</td>
            <td style="width: 100px">Дії</td>
        </tr>

        @foreach($product->characteristics as $item)
            <tr>
                <td>{{ $item->characteristic->name }}</td>
                <td>{{ $item->value }}</td>
                <td style="width: 100px">
                    <button data-type="get_form"
                            data-url="{{ route('admin.post', ['product', 'product_characteristics', 'update_form']) }}"
                            data-post="{{ params(['id' => $item->id]) }}"
                            class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-pencil"></i>
                    </button>

                    <button data-type="delete"
                            data-url="{{ route('admin.post', ['product', 'product_characteristics', 'delete']) }}"
                            data-id="{{ $item->id }}"
                            class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <h4 class="centered">@lang('common.empty')</h4>
@endif