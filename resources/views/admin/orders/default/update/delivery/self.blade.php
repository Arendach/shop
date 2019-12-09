<?php

$shops = asset_data('shops');

?>

<form data-type="ajax"
      data-success-driver="toastr"
      data-error-driver="toastr"
      data-url="{{ route('admin.post', ['orders', 'delivery', 'update_self']) }}">

    <input type="hidden" name="id" value="{{ $order->id }}">

    <div class="form-group">
        <label>Магазин</label>
        <select name="shop" class="form-control">
            @foreach($shops as $id => $item)
                <option {{ $id == $order->self->shop ? 'selected' : '' }} value="{{ $id }}">
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Дата доставки</label>
        <input class="form-control" type="date" name="date_delivery"
               value="{{ !is_null($order->date_delivery) ? $order->date_delivery->format('Y-m-d') : '' }}">    </div>

    <div class="form-group">
        <button class="btn btn-outline-primary">@lang('common.save')</button>
    </div>

</form>