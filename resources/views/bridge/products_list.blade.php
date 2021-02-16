@if(count($products) > 0)

    <form data-type="ajax" data-url="{{ route('bridge.post', ['products_sync', 'import']) }}">
        <input type="hidden" name="category_local" value="{{ $category_local }}">
        <div class="form-group">
            <div class="select" style="height: 100%" data-name="selected">
                @foreach($products as $item)
                    <div class="option" data-value="{{ $item->id }}">
                        {{ $item->articul }}
                        <hr style="margin: 5px 0">
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Імпортувати</button>
        </div>
    </form>
@else
    <div class="alert alert-warning">Упс. Результатов не найдено. Попробуйте еще...</div>
@endif