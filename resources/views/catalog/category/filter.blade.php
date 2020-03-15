<div class="filter_col">
    <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
    @foreach($filter['characteristics'] as $k => $characteristics)
        <div class="filter_type version_2">
            <h4>
                <a href="#ch_filter_{{ $characteristics['id'] }}" data-toggle="collapse" class="closed">
                    {{ $characteristics['name_' . config('locale.current')] }}
                </a>
            </h4>
            <div class="collapse" id="ch_filter_{{ $characteristics['id'] }}">
                <ul>
                    @foreach($characteristics['values'] as $characteristic)
                        <li>
                            <label class="container_check">
                                {{ $characteristic['value_' . config('locale.current')] }}
                                <input type="checkbox" {{ isset($requestFields['ch_' . $characteristics['id']]) && in_array($characteristic['value_' . config('locale.current')], $requestFields['ch_' . $characteristics['id']]) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach


    <div class="buttons">
        <a href="#0" class="btn_1">
            @translate('Фільтр')
        </a>
        <a href="#0" class="btn_1 gray">
            @translate('Скинути')
        </a>
    </div>
</div>
