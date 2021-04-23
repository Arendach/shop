<div id="filter-wrapper">
    <category-filter :data="{{ json_encode($categoryFilterData) }}"></category-filter>
</div>

@push('js')
    <script src="{{ asset('js/category-filter.js') }}"></script>
@endpush
