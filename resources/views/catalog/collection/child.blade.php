@php $admin_section = true @endphp

@extends('catalog.layout')

@section('style')

    <link rel="stylesheet" href="{{ asset('catalog/css/products.css') }}">
    <style>



    </style>

@endsection

@section('admin')

    <h4>@translate('Меню адміністратора'):</h4>

    <a href="{{ route('admin.get', ['product', 'collection', 'update']) . parameters(['id' => $collection->id])}}">
        <i class="fa fa-pencil"></i> @translate('Редагувати колекцію')
    </a> <br><br>

    <a href="{{ route('admin.get', ['product', 'collection', 'main'])}}">
        <i class="fa fa-pencil"></i> @translate('Колекції товарів')
    </a> <br>

    <a href="{{ route('admin.get', ['product', 'product', 'main'])}}">
        <i class="fa fa-pencil"></i> @translate('Товари')
    </a> <br>

    <a href="{{ route('admin.index')}}">
        <i class="fa fa-pencil"></i> @translate('Адмінка')
    </a>

@endsection

@section('content')

    <div class="container">
        <div class="products">

            <h1 class="page-header">{{ $collection->name }}</h1>

            @forelse($collection->items->chunk(4) as $chunk)
                <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                    @foreach($chunk as $item)
                        @include('catalog.product.chunk', ['chunks' => '3', 'item' => $item])
                    @endforeach
                </div>
            @empty
                <h4 class="centered">@translate('Тут порожньо')</h4>
            @endforelse
        </div>
    </div>

@endsection

@section('script')

    @include('catalog.assets.cart_scripts')

@endsection