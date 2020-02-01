<div class="top-menu">
    @if($menu->count())
        @foreach($menu as $item)
            <div class="drop-element {{ $item->type == 'drop' ? 'drop-down' : '' }}" data-id="menu-{{ $item->id }}">
                @if($item->type == 'link')
                    <a href="{{ url($item->url) }}">{{ $item->name }}</a>
                @else
                    <a>{{ $item->name }}</a>
                @endif

                @if($item->items->count())
                    <div class="drop-bridge"></div>
                    <div class="drop-items" id="menu-{{ $item->id }}">
                        @foreach($item->items as $item2)
                            @if($item2->type == 'link')
                                <a href="{{ url($item2->url) }}">{{ $item2->name }}</a>
                            @else
                                <a>{{ $item2->name }}</a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>