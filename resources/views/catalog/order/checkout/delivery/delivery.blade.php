<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Місто')</label>
    <input class="form-control form-control-sm" name="delivery_city" value="{{ Checkout::getField('city') != '' ? Checkout::getField('delivery_city') : 'Київ' }}">
    <div class="help-block" style="font-size: 14px;color: #9999">@translate('Київ або київська обл.')</div>
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label> <i class="text-danger">*</i> @translate('Вулиця')</label>
    <input class="form-control form-control-sm" name="delivery_street" value="{{ Checkout::getField('delivery_street') }}">
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label>@translate('Адреса')</label>
    <input class="form-control form-control-sm" name="delivery_address" value="{{ Checkout::getField('delivery_address') }}">
    <div class="feedback"></div>
</div>

<div class="form-group">
    <label>@translate('Дата')</label>
    <input class="form-control form-control-sm" name="delivery_date" type="date" value="{{ Checkout::getField('delivery_date') }}">
    <div class="feedback"></div>
</div>