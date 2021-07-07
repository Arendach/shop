@extends('catalog.layout')

@section('title', 'FAQ')

@section('content')

    <main>
        <div class="margin_30 container">

            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">@translate('Головна')</a></li>
                        <li>@translate('Часто задавані запитання')</li>
                    </ul>
                </div>
                <h1>@translate('Часто задавані запитання')</h1>
            </div>

            <div id="accordion">
                @foreach($faqs as $faq)
                    @php /** @var \App\Models\Faq $faq */ @endphp
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{ $faq->id }}">
                                    {!! $faq->editable('question') !!}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{ $faq->id }}" class="collapse {{ !$loop->index ? 'show' : '' }}" data-parent="#accordion">
                            <div class="card-body">
                                {!! $faq->editable('answer') !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

@endsection