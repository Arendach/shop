<ul class="list-group">
    @foreach($hints as $item)
        <li data-value="{{ $item->uri_name }}" class="list-group-item hint">
            {{ $item->uri_name }}
        </li>
    @endforeach
</ul>