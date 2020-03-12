@inject('str',"Illuminate\\Support\\Str")
@extends('catalog-old.layout')

@section('style')
    <style>
        .cat-list {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
        }

        .cat-item {
            width: calc(100% / 4 - 15px);
            margin-top: 20px;
        }

        .cat-item:nth-child(1), .cat-item:nth-child(2), .cat-item:nth-child(3), .cat-item:nth-child(4) {
            margin-top: 0;
        }

        .cat-image {
            height: 200px;
            width: 100%;
            text-align: center;

        }

        .cat-image div {
            height: 200px;
            width: 250px;
            display: inline-block;
            background: no-repeat center;
            background-size: contain;
        }

        .cat-name {
            padding: 10px;
            font-size: 18px;
        }

        .cat-name a {
            color: #0f6674;
        }

        .cat-links {
            padding: 0 10px;
        }

        .cat-link a {
            color: #0f6674;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        @if($category->child->count())
            <div class="cat-list">
                @foreach($category->child as $item)
                    <div class="cat-item">
                        <div class="cat-image">
                            <div style="background-image: url('{{ $item->small_image }}')"></div>
                        </div>

                        <div class="cat-name">
                            <a href="{{ route('category.show', $item->slug) }}">
                                {{ $item->name }}
                            </a>
                        </div>

                        @if(count($item->links) > 0)
                            <div class="cat-links">
                                @foreach($item->links as $link)
                                    <div class="cat-link">
                                        <a href="{{ $link->url }}">-- {{ $link->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <h1>@translate('Тут порожньо')</h1>
        @endif
    </div>

@endsection