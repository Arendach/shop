@inject('str', "Illuminate\\Support\\Str")

@extends('admin.layout')

@section('content')

    @if($orders->count() > 0)

        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th>Імя</th>
                <th>Телефон</th>
                <th>ІП</th>
                <th>Товар</th>
                <th style="width: 91px">Дії</th>
            </tr>
            </thead>

            <tbody>
            @foreach($orders as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>
                        <a href="{{ route('product.view', [$str->slug($item->product->name), $item->product->id]) }}">
                            {{ $item->product->name }}
                        </a>
                    </td>
                    <td style="width: 91px">
                        @if(!$item->accepted)
                            <button data-type="ajax_request"
                                    data-post="{{ params(['id' => $item->id]) }}"
                                    data-url="{{ route('admin.post', ['orders', 'simple_orders', 'ok']) }}"
                                    class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-check"></i>
                            </button>
                        @else
                            <button class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i>
                            </button>
                        @endif

                        <button data-type="delete"
                                data-url="{{ route('admin.post', ['orders', 'simple_orders', 'delete']) }}"
                                data-id="{{ $item->id }}"
                                class="btn btn-sm btn-outline-danger">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="centered">{{ $orders->links() }}</div>

    @else
        <h4 class="centered">This is empty :((</h4>
    @endif

@endsection('content')