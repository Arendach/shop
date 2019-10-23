@extends('admin.layout')

@section('content')

    <ul class="nav nav-pills nav-justified mb">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#info">@lang('category.admin.info')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#seo">SEO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#characteristics">@lang('products.admin.characteristics')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#images">@lang('products.admin.images')</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="info">
            @include('admin.products.edit_parts.info')
        </div>

        <div class="tab-pane fade" id="seo">
            @include('admin.products.edit_parts.seo')
        </div>

        <div class="tab-pane fade" id="characteristics">
            @include('admin.products.edit_parts.characteristics')
        </div>

        <div class="tab-pane fade" id="images">
            @include('admin.products.edit_parts.images')
        </div>
    </div>

@endsection

@section('script')

@endsection
