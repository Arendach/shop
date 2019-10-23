@extends('admin.layout')

@section('content')

    <div class="right mb">
        <a href="{{ route('admin.get', ['product', 'product', 'create']) }}" class="btn btn-outline-success">
            @lang('products.admin.new_product')
        </a>
    </div>

    @if(count($products) > 0)
        <table class="table table-bordered">
            <tr>
                <th>@lang('products.admin.name')</th>
                <th>@lang('products.admin.article')</th>
                <th>@lang('products.admin.price')</th>
                <th>@lang('products.admin.category')</th>
                <th class="action2">@lang('common.actions')</th>
            </tr>
            @foreach($products as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->article }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{ route('admin.get', ['category', 'category', 'update']) . parameters(['id' => $item->category_id]) }}">
                            {{ $item->category->name }}
                        </a>
                    </td>

                    <td class="action2">
                        <a href="{{ route('admin.get', ['product', 'product', 'update']) .parameters(['id' => $item->id]) }}"
                           title="@lang('common.edit')"
                           class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-pencil"></i>
                        </a>

                        <button data-type="delete"
                                title="@lang('common.del')"
                                data-url="{{ route('admin.post',['product', 'product', 'delete']) }}"
                                data-id="{{ $item->id }}"
                                class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="centered">
            {{ $products->links() }}
        </div>

    @else
        <h4 class="centered">@lang('common.empty')</h4>
    @endif

@endsection('content')
