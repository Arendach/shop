<div>
    <div class="form-group">
        <label>Пошук товарів</label>
        <input id="products_search" class="form-control">
    </div>
</div>

<hr>

<form data-url="{{ route('admin.post', ['orders', 'products', 'update']) }}" data-type="ajax">
    <input type="hidden" name="id" value="{{ $order->id }}">
    <table class="table table-bordered products">
        <tr>
            <th>@lang('order.admin.product.name')</th>
            <th>@lang('order.admin.product.amount')</th>
            <th>@lang('order.admin.product.price')</th>
            <th>@lang('order.admin.product.storage')</th>
            <th>@lang('common.actions')</th>
        </tr>

        @forelse($order->products as $item)
            @include('admin.orders.default.update.product_row', [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'product_key' => $item->product_key,
                'amount' => $item->pivot->amount,
                'price' => $item->pivot->price,
                'storage' => $item->pivot->storage,
                'storages' => $storages,

            ])
        @empty
            <tr>
                <td colspan="5"><h4 class="centered">Тут пусто :(</h4></td>
            </tr>
        @endforelse

    </table>

    <div class="form-group">
        <label>Знижка</label>
        <input class="form-control" name="discount" value="{{ $order->discount }}">
    </div>

    <div class="form-group">
        <label>Ціна доставки</label>
        <input class="form-control" name="delivery_costs" value="{{ $order->delivery_costs }}">
    </div>

    <div class="form-group">
        <label>Сума(за товари)</label>
        <input id="products_sum" class="form-control" disabled value="{{ $order->sum }}">
    </div>

    <div class="form-group">
        <button class="btn btn-outline-primary">
            @lang('common.save')
        </button>
    </div>
</form>

<script>
    $(document).on('keyup', '.product-row input', function () {
        let sum = 0;
        $('.product-row').each(function () {
            let amount = $(this).find('.product-amount').val();
            let price = $(this).find('.product-price').val();

            sum += amount * price;
        });

        $('#products_sum').val(sum);
    });


    $('#products_search').autocomplete({
        source: function (request, response) {
            let exept = [];
            $('.product-row').each(function () {
                exept.push($(this).data('id'))
            })

            $.post('{{ route('admin.post', ['orders', 'products', 'search']) }}', {
                term: request.term,
                exept
            }, function (a) {
                response(a);
            }, 'json');
        },
        minLength: 2,
        select: function (event, ui) {
            $.post('{{ route('admin.post', ['orders', 'products', 'searched']) }}', {
                id: ui.item.id
            }, function (response) {
                $('#products_search').val('');
                $('.products').append(response);
            });
        }
    });
</script>