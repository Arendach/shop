<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Місто')</label>
    <select class="form-control form-control-sm" id="sending_city"></select>
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Відділення')</label>
    <select class="form-control form-control-sm" id="sending_warehouse" name="warehouse_id" {{ !Checkout::issetWarehouses() ? 'disabled' : '' }}>
        {!! Checkout::getWarehouses() !!}
    </select>
    <div class="feedback"></div>
</div>