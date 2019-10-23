@extends('admin.layout')

@section('content')

    <div class="right mb">
        <a href="{{ route('admin.get', ['category', 'category', 'create']) }}" class="btn btn-outline-success">
            @lang('category.admin.new_category')
        </a>
    </div>

    @if(count($categories) > 0)
        <table class="table-bordered table">
            <tr>
                <th>@lang('category.admin.name')</th>
                <th>@lang('category.admin.title')</th>
                <th>@lang('category.admin.parent')</th>
                <th class="action2">@lang('common.actions')</th>
            </tr>
            @foreach($categories as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->meta_title }}</td>
                    <td>
                        {{ is_null($item->parent) ? __('category.admin.root') : $item->parent->name }}
                    </td>
                    <td class="action2">
                        <a href="{{ route('admin.get', ['category', 'category', 'update']) . parameters(['id' => $item->id]) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-pencil"></i>
                        </a>

                        <button data-type="delete"
                                data-after="remove"
                                data-url="{{ route('admin.post', ['category', 'category', 'delete']) }}"
                                data-id="{{ $item->id }}"
                                class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">@lang('common.empty')</h4>
    @endif

@endsection('content')
