@extends('bridge.layout')

@section('content')

    <form id="search_products_form">
        <div class="form-group">
            <label>Виберіть локальну категорію</label>
            <select name="category_local" class="form-control">
                @foreach($categories_local as $item)
                    <option disabled>{{ $item->name }}</option>
                    @foreach($item->child as $child)
                        <option value="{{ $child->id }}">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - {{ $child->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Артикул або назва</label>
            <input class="form-control" name="search_string">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Шукати</button>
        </div>
    </form>

    <div id="place_searched"></div>

@endsection


@section('script')

    <script type="module">
        $(document).on('submit', '#search_products_form', function (event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{ route('bridge.post', ['products_sync', 'search']) }}',
                data: {
                    search_string: $('[name="search_string"]').val(),
                    category_local: $('[name="category_local"]').val()
                },
                success(answer) {
                    $('#place_searched').html(answer);
                },
                error(answer) {
                    alert('Unknown error!');

                    console.log(answer);
                }
            });
        });
    </script>

@endsection