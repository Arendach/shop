<tr class="product-row" data-id="{{ $id }}">
    <td>
        <input type="hidden" name="product[{{$id}}][product_id]" value="{{ $id }}">

        <a href="{{ route('product.view', $slug) }}">
            {{ $name }}
        </a>
    </td>

    <td>
        <input class="product-amount" name="product[{{$id}}][amount]" value="{{ $amount }}">
    </td>

    <td>
        <input class="product-price" name="product[{{$id}}][price]" value="{{ $price }}">
    </td>

    <td>
        <select name="product[{{$id}}][storage]">
            @isset($storages->{$product_key})
                @foreach($storages->{$product_key} as $item)
                    <option {{ $item->id == $storage ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name . ': ' . $item->count }}
                    </option>
                @endforeach
            @endisset
        </select>
    </td>

    <td>
        <button onclick="$(this).parents('tr').remove()" class="btn btn-outline-danger btn-sm">
            <i class="fa fa-remove"></i>
        </button>
    </td>
</tr>