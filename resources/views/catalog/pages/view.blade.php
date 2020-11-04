@php /** @var \App\Models\Page $page */ @endphp
@extends('catalog.layout')

@section('title', $title ?? $globalData->meta_title)

@section('content')

    <main>
        <div class="container mt-11 mb-11">
            <div style="margin: 40px 0" class="page-wrapper">
                {!! $page->content !!}
            </div>
        </div>
    </main>

@endsection