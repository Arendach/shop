@if($order->delivery == 'delivery')

    @include('admin.orders.default.update.delivery.delivery')

@elseif($order->delivery == 'sending')

    @include('admin.orders.default.update.delivery.sending')

@elseif($order->delivery == 'self')

    @include('admin.orders.default.update.delivery.self')

@endif
