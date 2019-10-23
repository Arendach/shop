@extends('admin.layout')

@section('content')

    <div class="right mb">
        <a href="{{ route('pages.create') }}" class="btn btn-primary">@lang('pages.new_page')</a>
    </div>

    @if(count($pages) > 0)
        <table class="table table-bordered">
            <tr>
                <th>@lang('pages.name')</th>
                <th>@lang('pages.uri_name')</th>
                <th>@lang('pages.created_at')</th>
                <th class="action2">@lang('common.actions')</th>
            </tr>
            @foreach($pages as $item)
                <tr>
                    <td>
                        {{ $item->name }}
                    </td>

                    <td>
                        {{ $item->uri_name }}
                    </td>

                    <td>
                        <span title="{{ $item->created_at }}" data-toggle="tooltip">
                            {{ is_null($item->created_at) ? '' : $item->created_at->diffForHumans() }}
                        </span>
                    </td>

                    <td class="action2">
                        <a href="{{ route('pages.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-pencil"></i>
                        </a>

                        <button
                                data-type="delete"
                                data-url="{{ route('pages.destroy', ['page' => $item->id]) }}"
                                class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        
        {{ $pages->links() }}
    @else
        <h4 class="centered">@lang('common.empty')</h4>
    @endif

@endsection('content')