@php /** @var \App\Models\Category $category */ @endphp

@extends('catalog.layout')

@section('title', $category->name)

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('css')
    <link href="{{ asset('catalog/css/listing.css') }}" rel="stylesheet">
@endsection

@section('content')

    @dd($category)

@endsection

@section('js')

@endsection