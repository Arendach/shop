@php /** @var \App\Models\Order $order */ @endphp
        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Нове замовлення</title>
</head>
<body style="background-color: #d4edda; padding: 0 10%">

<h1 style="font-family: Roboto, Arial, Helvetica, sans-serif; text-align: center; color: #3B5998">
    Нове замовлення на сайті <a href="{{ url('/') }}">{{ request()->getHost() }}</a>
</h1>

<table style="width: 100%; border: 1px solid black; border-collapse: collapse">
    <tr>
        <td style="border: 1px solid black; padding: 10px; background-color: #666699; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
            Імя
        </td>

        <td style="border: 1px solid black; padding: 10px; background-color: #666699; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
            {{ $order->name }}
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
            Номер телефону
        </td>

        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
            <a href="tel:{{ $order->phone }}">
                {{ $order->phone }}
            </a>
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
            Email
        </td>
        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
            <a href="mailto:{{ $order->email }}">
                {{ $order->email }}
            </a>
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
            Спосіб доставки
        </td>

        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
            {{ asset_data('order_types')[$order->delivery]['name'] }}
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
            Спосіб оплати
        </td>

        <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
            {{ asset_data('pay_methods')[$order->pay_method]['name'] }}
        </td>
    </tr>
    @if($order->humanDate('delivery'))
        <tr>
            <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
                Бажана дата доставки
            </td>

            <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
                {{ $order->humanDate('delivery') }}
            </td>
        </tr>
    @endif

    @if($order->comment)
        <tr>
            <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
                Коментар до замовлення
            </td>

            <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
                {{ $order->comment }}
            </td>
        </tr>
    @endif

    @if($order->_delivery)
        @if($order->_delivery->city)
            <tr>
                <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
                    Місто
                </td>

                <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
                    {{ $order->_delivery->city }}
                </td>
            </tr>
        @endif

        @if($order->_delivery->street)
            <tr>
                <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
                    Вулиця
                </td>

                <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
                    {{ $order->_delivery->street }}
                </td>
            </tr>
        @endif

        @if($order->_delivery->address)
            <tr>
                <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif">
                    Адреса
                </td>

                <td style="border: 1px solid black; padding: 10px; background-color: #9999CC; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; font-weight: bold">
                    {{ $order->_delivery->address }}
                </td>
            </tr>
        @endif
    @endif
</table>

<br>

<table style="width: 100%; border: 1px solid black; border-collapse: collapse">
    <tr>
        <th style="border: 1px solid white; padding: 10px; background-color: #99FFCC; text-shadow: 1px 1px 2px black; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; border-top-right-radius: 10px; border-top-left-radius: 10px">
            Товар
        </th>

        <th style="border: 1px solid white; padding: 10px; background-color: #99FFCC; text-shadow: 1px 1px 2px black; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; border-top-right-radius: 10px; border-top-left-radius: 10px">
            Кількість
        </th>

        <th style="border: 1px solid white; padding: 10px; background-color: #99FFCC; text-shadow: 1px 1px 2px black; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; border-top-right-radius: 10px; border-top-left-radius: 10px">
            Ціна
        </th>

        <th style="border: 1px solid white; padding: 10px; background-color: #99FFCC; text-shadow: 1px 1px 2px black; color: white; font-family: Roboto, Arial, Helvetica, sans-serif; border-top-right-radius: 10px; border-top-left-radius: 10px">
            Сума
        </th>
    </tr>
    @foreach($order->products as $product)
        <tr>
            <td style="border: 1px solid white; padding: 10px; background-color: #FFCC99; color: #333366; font-family: Roboto, Arial, Helvetica, sans-serif">
                <a style="color: #333366" href="{{ $product->url }}">{{ $product->name }}</a>
            </td>

            <td style="border: 1px solid white; padding: 10px; background-color: #FFCC99; color: #333366; font-family: Roboto, Arial, Helvetica, sans-serif">
                {{ $product->pivot->amount }}
            </td>

            <td style="border: 1px solid white; padding: 10px; background-color: #FFCC99; color: #333366; font-family: Roboto, Arial, Helvetica, sans-serif">
                {{ number_format($product->pivot->price) }}
            </td>

            <td style="border: 1px solid white; padding: 10px; background-color: #FFCC99; color: #333366; font-family: Roboto, Arial, Helvetica, sans-serif">
                {{ number_format($product->pivot->price * $product->pivot->amount) }}
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>