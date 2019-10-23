@extends('admin.layout')

@section('content')
    
    <div class="right mb">
        <a href="{{ route('discounts.create') }}" class="btn btn btn-primary">
            @lang('banner.admin.create_discount')
        </a>
    </div>

    @if(count($discounts) > 0)
        <table class="table table-bordered">
            <tr>
                <th>@lang('banner.admin.photo')</th>
                <th>@lang('banner.admin.distinct')</th>
                <th>@lang('banner.admin.name')</th>
                <th>@lang('banner.admin.page')</th>
                <th>@lang('banner.admin.published')</th>
                <th class="action2">@lang('common.actions')</th>
            </tr>
            @foreach($discounts as $item)
                <tr>
                    <td>
                        <img src="{{ preg_match('@^https?@', $item->image_min) ? $item->image_min : asset($item->image_min) }}">
                    </td>

                    <td>
                        {{ $item->start_f . ' - ' . $item->finish_f }}
                    </td>

                    <td>
                        {{ $item->name }}
                    </td>

                    <td>
                        <a href="{{ route('page', $item->page) }}">{{ $item->page }}</a>
                    </td>

                    <td>
                        {{ $item->published ? __('banner.admin.is_published') : __('banner.admin.is_not_published') }}
                    </td>

                    <td class="action2">
                        <a href="{{ route('discounts.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-pencil"></i>
                        </a>

                        <button data-type="delete" data-url="{{ route('discounts.destroy', $item->id) }}" class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="centered">
            {{ $discounts->links() }}
        </div>
    @else
        <h4 class="centered">@lang('common.empty')</h4>
    @endif

@endsection('content')