@extends('catalog-old.layout')

@section('style')

    <style>
        .page{
            margin-top: 20px;
            box-shadow: 0 0 5px #eee;
            padding: 20px 10px;
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <div class="page">
            {!! $page->content !!}
        </div>
    </div>

@endsection
