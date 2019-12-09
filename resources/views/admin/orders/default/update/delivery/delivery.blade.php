<form data-type="ajax" data-url="{{ route('admin.post', ['orders', 'delivery', 'update_delivery']) }}">
    <input type="hidden" name="id" value="{{ $order->id }}">

    <div class="form-group">
        <label>Місто</label>
        <input class="form-control" name="city" value="{{  $order->_delivery->city }}">
    </div>

    <div class="form-group">
        <label>Вулиця</label>
        <input class="form-control" name="street" value="{{  $order->_delivery->street }}">
    </div>

    <div class="form-group">
        <label>Адреса</label>
        <input class="form-control" name="address" value="{{  $order->_delivery->address }}">
    </div>

    <div class="form-group">
        <label>Дата доставки</label>
        <input class="form-control" type="date" name="date_delivery"
               value="{{ !is_null($order->date_delivery) ? $order->date_delivery->format('Y-m-d') : '' }}">
    </div>

    <div class="form-group">
        <button class="btn btn-outline-primary">
            @lang('common.save')
        </button>
    </div>
</form>