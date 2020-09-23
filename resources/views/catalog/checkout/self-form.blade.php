<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Магазин')</label>
    <select class="form-control form-control-sm" name="shop_id" required>
        <option hidden value="">@translate('Вибрати')</option>
        @foreach(\App\Models\Shop::all() as $item)
            <option @selected(Checkout::getField('self_shop') == $item->base_id) value="{{ $item->base_id }}">
                {{ $item->name }} - {{ $item->address }}
            </option>
        @endforeach
    </select>
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label>@translate('Дата')</label>
    <input class="form-control form-control-sm" name="date_delivery" type="date" value="{{ Checkout::getField('self_date') }}">
    <div class="feedback"></div>
</div>