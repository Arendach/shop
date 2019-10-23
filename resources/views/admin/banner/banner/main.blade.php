@extends('admin.layout')

@section('content')

    <div class="pull-right mb">
        <a href="{{ route('admin.get', ['banner', 'banner', 'create']) }}" class="btn btn-primary">@lang('banner.admin.create')</a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>@lang('banner.admin.photo')</th>
            <th>@lang('banner.admin.title')</th>
            <th>@lang('banner.admin.description')</th>
            <th>@lang('common.actions')</th>
        </tr>
        @foreach($images as $item)
            <tr>
                <td><img src="{{ preg_match('@^https?@', $item->path) ? $item->path : asset($item->path) }}" width="200px" alt=""></td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="{{ route('admin.get', ['banner', 'banner', 'edit']) . parameters(['id' => $item->id]) }}"
                       class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button data-type="delete"
                            data-url="{{ route('admin.get', ['banner', 'banner', 'destroy']) }}"
                            data-id="{{ $item->id }}"
                            class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>

@endsection('content')
