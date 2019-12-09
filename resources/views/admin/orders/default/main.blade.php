@extends('admin.layout')

@section('content')

    @if($orders->count())
        <table class="table table-bordered">
            <tr>
                <td>#</td>
                <td>@lang('order.name')</td>
                <td>@lang('order.phone')</td>
                <td>@lang('order.type')</td>
                <td>@lang('order.status')</td>
                <td>@lang('order.sum')</td>
                <td>@lang('order.date')</td>
                <td>@lang('common.actions')</td>
            </tr>
            @foreach($orders as $item)
                <tr style="background-color: {{ $item->base_id ? $assets['colors']['imported'] : $assets['colors']['not_imported'] }}">
                    <td>
                        {{ $item->id }}
                    </td>

                    <td>
                        {{ $item->name }}
                    </td>

                    <td>
                        {{ $item->phone }}
                    </td>

                    <td>
                        {{ $assets['types'][$item->delivery]['name'] }}
                    </td>

                    <td>
                        <span style="color: {{ $assets['statuses'][$item->status]['color'] }}">
                            {{ $assets['statuses'][$item->status]['name'] }}
                        </span>
                    </td>

                    <td>
                        {{ $item->sum }}
                    </td>

                    <td>
                        {{ $item->created_at->format('d / m / Y H:i') }}
                    </td>

                    <td>
                        <a href="{{ route('admin.get', ['orders', 'default', 'update']) . parameters(['id' => $item->id]) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $orders->links() }}
    @else
        <h4 class="centered">
            @lang('common.empty')
        </h4>
    @endif

@stop