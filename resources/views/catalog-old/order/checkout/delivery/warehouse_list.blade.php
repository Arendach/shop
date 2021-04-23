@forelse($warehouses as $item)
    <option {{ Checkout::getField('sending_warehouse') != '' && Checkout::getField('sending_warehouse') == $item['key'] ? 'selected' : '' }} value="{{ $item['key'] }}">
        {{ $item['name'] }}
    </option>
@empty
    <option value="0">
        -
    </option>
@endforelse