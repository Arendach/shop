<style>
        .city-item:hover{
                cursor: pointer;
                color: #0f6674;
        }
</style>

<ul class="list-group">

    @forelse($city_list as $item)
        <li style="padding: 5px 10px" data-name="{{ $item->get('name') }}" data-key="{{ $item->get('key') }}" class="list-group-item city-item">
                {{ $item->get('description') }}
        </li>
    @empty
        <li style="padding: 5px 10px" class="list-group-item">@translate('Не знайдено')</li>
    @endforelse


</ul>