@php $admin_section = true @endphp

@extends('catalog.layout')

@section('style')

    <style>
        .collections {
            box-shadow: 0 0 5px #eee;
            padding: 20px;
            margin-top: 15px
        }
    </style>

@endsection



@section('admin')

    <h4>Меню адміністратора:</h4>
    <a href="{{ route('admin.get', ['product', 'collection', 'main'])}}">
        <i class="fa fa-pencil"></i> Колекції товарів
    </a> <br>

    <a href="{{ route('admin.get', ['product', 'product', 'main'])}}">
        <i class="fa fa-pencil"></i> Товари
    </a> <br>

    <a href="{{ route('admin.index')}}">
        <i class="fa fa-pencil"></i> Адмінка
    </a>


@endsection

@section('content')

    <div class="container">
        <div class="collections">
            @if($collections->count())
                @foreach($collections->chunk(3) as $chunk)
                    <div class="row" {!! !$loop->last ? 'style="margin-bottom: 20px"' : '' !!}>
                        @foreach($chunk as $item)
                            <div class="col-4">
                                <ul class="list-group">

                                    <li class="list-group-item" style="background: #e31837; color: #fff">
                                        <h3>{{ $item->name  }}</h3>
                                    </li>

                                    <li class="list-group-item" style="padding: 0">
                                        <img width="100%" src="{{ $item->image }}" alt="">
                                    </li>

                                    @if($item->child->count())
                                        @foreach($item->child as $child)
                                            <li class="list-group-item">
                                                <a href="{{ route('collection', $child->slug) }}">
                                                    <i class="fa fa-tags"></i> {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <h4 class="centered">@lang('common.empty')</h4>
            @endif
        </div>
    </div>

@endsection

<script>

</script>