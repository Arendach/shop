@php $admin_section = true

/**
* @var $collection \Illuminate\Support\Collection
* @var $item App\Models\ProductCollection
*/

@endphp

@extends('catalog.layout')

@section('style')

    <style>
        .collections {
            box-shadow: 0 0 5px #eee;
            padding: 20px;
            margin-top: 15px
        }

        .collection {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>

@endsection

@section('admin')

    <h3>Меню адміністратора:</h3>
    <a href="{{ route('admin.get', ['product', 'collection', 'main'])}}">
        <i class="fa fa-pencil"></i> Управління колекціями
    </a>

@endsection

@section('content')

    <div class="container">
        <div class="collections">
            @if($collection->child->count())
                @foreach($collection->child->chunk(4) as $chunks)
                    <div class="row" style="margin-bottom: 15px">
                        @foreach($chunks as $item)
                            <div class="col-3">
                                <div class="collection">
                                    <img style="margin-bottom: 7px" src="{{ $item->image }}" alt="{{ $item->name }}"
                                         width="100%">

                                    <h5>
                                        <a href="{{ route('collection', $item->slug) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h5>

                                    <hr>

                                    <div>
                                        {!! $item->description !!}
                                    </div>
                                    @if(is_admin())
                                        <hr>
                                        <div>
                                            <a href="{{ route('admin.get', ['product', 'collection', 'update']) . parameters(['id' => $item->id]) }}">
                                                <i class="fa fa-pencil"></i> Редагувати колекцію
                                            </a>
                                        </div>
                                    @endif
                                </div>
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