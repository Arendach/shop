<div class="form-group">
    <label> <i class="text-danger">*</i> Магазин</label>
    <select class="form-control form-control-sm" name="self_shop">
        @foreach(asset_data('shops') as $item)
            <option {{ Checkout::getField('self_shop') == $item['base_id'] ? 'selected' : '' }} value="{{ $item['base_id'] }}">
                {{ Delivery::getSelfShopName($item['base_id']) . ' - ' . Delivery::getSelfShopAddress($item['base_id']) }}
            </option>
        @endforeach
    </select>
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label>Дата</label>
    <input class="form-control form-control-sm" name="self_date" type="date" value="{{ Checkout::getField('self_date') }}">
    <div class="feedback"></div>
</div>