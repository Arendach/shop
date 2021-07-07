{{--<div class="pagination__wrapper">--}}
{{--    <ul class="pagination">--}}
{{--        <li><a href="#0" class="prev" title="previous page">&#10094;</a></li>--}}
{{--        <li>--}}
{{--            <a href="#0" class="active">1</a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#0">2</a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#0">3</a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#0">4</a>--}}
{{--        </li>--}}
{{--        <li><a href="#0" class="next" title="next page">&#10095;</a></li>--}}
{{--    </ul>--}}
{{--</div>--}}


@if ($paginator->hasPages())
    <div class="pagination__wrapper">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{--                <li><a href="javascript:void(0)" class="active">1</a></li>--}}
            @else
                <li><a href="{{ paginatorUrl($paginator->previousPageUrl()) }}" class="prev" title="previous page">&#10094;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a href="javascript:void(0)">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a href="javascript:void(0)" class="active">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ paginatorUrl($url) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ paginatorUrl($paginator->nextPageUrl()) }}" class="next" title="next page">&#10095;</a></li>
            @else
                {{--                <li><a href="javascript:void(0)" class="active">{{ $paginator->lastPage() }}</a></li>--}}
            @endif
        </ul>
@endif