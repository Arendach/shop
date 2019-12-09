@extends('admin.layout')

@section('content')

    <table class="table table-bordered">
        <tr>
            <td>Назва</td>
            <td>URL</td>
            <td style="width: 100px">Дії</td>
        </tr>
        @forelse($collections as $item)
            <tr>
                <td>
                    {{ $item->name }}
                </td>

                <td>
                    <a href="{{ route('collection', $item->slug) }}">
                        {{ route('collection', $item->slug) }}
                    </a>
                </td>
                <td style="width: 100px">
                    <a href="{{ route('admin.get', ['product', 'collection', 'update']).parameters( ['id' => $item->id]) }}"
                       class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <a href="" class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-remove"></i>
                    </a>
                </td>
            </tr>

            @foreach($item->child as $child)
                <tr>
                    <td>
                        ----- {{ $child->name }}
                    </td>

                    <td>
                        <a href="{{ route('collection', $child->slug) }}">
                            {{ route('collection', $child->slug) }}
                        </a>
                    </td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.get', ['product', 'collection', 'update']).parameters( ['id' => $child->id]) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-pencil"></i>
                        </a>

                        <button data-type="delete"
                                data-url="{{ route('admin.post', ['product', 'collection', 'delete']) }}"
                                data-id="{{ $child->id }}"
                           class="btn btn-sm btn-outline-danger">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="4" class="centered">
                    <h4>@lang('common.empty')</h4>
                </td>
            </tr>
        @endforelse
    </table>

@stop