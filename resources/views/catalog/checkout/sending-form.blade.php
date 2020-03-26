<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Місто')</label>
    <select class="form-control form-control-sm" id="sending_city" name="sending_city" value="{{ Checkout::getField('sending_city') }}"></select>
    <input type="hidden" name="sending_city_key" value="{{ Checkout::getField('sending_city_key') }}">
    <div id="city-list"></div>
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Відділення')</label>
    <select class="form-control form-control-sm" id="sending_warehouse" name="sending_warehouse" {{ !Checkout::issetWarehouses() ? 'disabled' : '' }}>
        {!! Checkout::getWarehouses() !!}
    </select>
    <div class="feedback"></div>
</div>