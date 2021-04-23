@extends('catalog.layout')

@section('title', translate('Результати пошуку'))

@section('content')

    <main class="bg_gray">
        <div class="container margin_30">
            <div style="margin: 0 0 30px 0">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('index') }}">@translate('Головна')</a></li>
                        <li>@translate('Результати пошуку')</li>
                    </ul>
                </div>
            </div>

            @if($products->count())
                <div class="row small-gutters">
                    @foreach($products as $product)
                        @php /** @var \App\Models\Product $product */ @endphp
                        <div class="col-6 col-md-4 col-xl-3">
                            @include('catalog.parts.product-card')
                        </div>
                    @endforeach
                </div>

                {!! $products->links('catalog.parts.paginate') !!}
            @else
                <h3 style="text-align: center; display: block; margin: 30px">
                    @translate('За вашим запитом нічого не знайдено')
                </h3>
            @endif

        </div>
    </main>

@endsection