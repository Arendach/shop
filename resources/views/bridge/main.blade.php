@extends('bridge.layout')

@section('content')

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        <hr>
    @endif

    <h2 class="text-info" style="margin-bottom: 0">Синхронізація</h2>
    <hr style="margin-top: 0">

    <a href="{{ route('bridge.get', ['manufacturers_sync', 'main']) }}">
        Синхронізувати виробників
    </a><br>

    <a href="{{ route('bridge.get', ['attributes_sync', 'main']) }}">
        Синхронізувати атрибути товарів
    </a><br>

    <a href="{{ route('bridge.get', ['characteristics_sync', 'main']) }}">
        Синхронізувати характеристики товарів
    </a><br>

    <a href="{{ route('bridge.get', ['products_sync', 'on_storage']) }}">
        Синхронізувати наявність товару на складі
    </a><br>

    <h2 class="text-info" style="margin-bottom: 0; margin-top: 20px">Імпорт</h2>
    <hr style="margin-top: 0">

    <a href="{{ route('bridge.get', ['products_sync', 'main']) }}">
        Імпорт товарів
    </a><br>

@endsection('content')