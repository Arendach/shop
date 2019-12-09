@inject('newPostService', App\Services\NewPostService)

@php $warehouses = $newPostService->getWarehouses($order->sending->city_key ?? ''); @endphp

<form data-type="ajax"
      data-success-driver="toastr"
      data-error-driver="toastr"
      data-url="{{ route('admin.post', ['orders', 'delivery', 'update_sending']) }}">
    <input type="hidden" name="id" value="{{ $order->id }}">

    <div class="form-group">
        <label>Місто</label>
        <input type="hidden" name="city_key" value="{{ $order->sending->city_key }}">
        <input id="city_name" class="form-control" value="{{ $order->sending->city_name }}">
    </div>

    <div class="form-group">
        <label>Відділення</label>
        <select class="form-control" name="warehouse_key">
            @foreach($warehouses as $item)
                <option {{ $item['key'] == $order->sending->warehouse_key ? 'selected' : '' }} value="{{ $item['key'] }}">
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Дата доставки</label>
        <input class="form-control" type="date" name="date_delivery"
               value="{{ !is_null($order->date_delivery) ? $order->date_delivery->format('Y-m-d') : '' }}">
    </div>


    <div class="form-group">
        <button class="btn btn-outline-primary">@lang('common.save')</button>
    </div>
</form>

<script>
    $('#city_name').autocomplete({
        source: function (request, response) {
            $.post('{{ route('admin.post', ['orders', 'delivery', 'search_sending_city']) }}', {
                term: request.term
            }, function (a) {
                response(a);
            }, 'json');
        },
        minLength: 2,
        select: function (event, ui) {
            $('[name="city_key"]').val(ui.item.id);

            $.post('{{ route('admin.post', ['orders', 'delivery', 'search_sending_warehouses']) }}', {
                id: ui.item.id
            }, function (response) {
                $('[name="warehouse_key"]').html(response.content);
            }, 'json');
        }
    });
</script>