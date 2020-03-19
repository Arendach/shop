<div class="filter_col">
    <form action="{{ url()->current() }}">
        @foreach(request()->except('manufacturers', 'price', 'characteristics') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>

        <div class="filter_type version_2">
            <h4>
                <a href="#price" data-toggle="collapse" class="opened collapsed">
                    @translate('Ціна')
                </a>
            </h4>
            <div class="collapse show" id="price">
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-6">
                                <label>@translate('Від'):</label>
                                <input type="text" class="form-control form-control-sm" name="min_price" value="{{ request('min_price') ? request('min_price') : $filter->getMinPrice() }}">
                            </div>
                            <div class="col-6">
                                <label>@translate('До'):</label>
                                <input type="text" class="form-control form-control-sm" name="max_price" value="{{ request('max_price') ? request('max_price') : $filter->getMaxPrice() }}">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="filter_type version_2">
            <h4>
                <a href="#manufacturers" data-toggle="collapse" class="opened collapsed">
                    @translate('Виробник')
                </a>
            </h4>
            <div class="collapse show" id="manufacturers">
                <ul>
                    @foreach($filter->getManufacturers() as $manufacturer)
                        <li>
                            <label class="container_check">
                                {{ $manufacturer->name }}
                                <input type="checkbox"
                                       name="manufacturers[]"
                                       value="{{ $manufacturer->id }}"
                                        @checked($manufacturer->isChecked())
                                >
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @foreach($filter->getCharacteristics() as $characteristic)
            <div class="filter_type version_2">
                <h4>
                    <a href="#ch_filter_{{ $characteristic->id }}" data-toggle="collapse"
                       class="{{ $loop->index < 3 ? 'opened collapsed' : 'closed' }}">
                        {{ $characteristic->name }}
                    </a>
                </h4>
                <div class="collapse {{ $loop->index < 3 ? 'show' : '' }}" id="ch_filter_{{ $characteristic->id }}">
                    <ul>
                        @foreach($characteristic->getValues() as $productCharacteristic)
                            <li>
                                <label class="container_check">
                                    {{ $characteristic->prefix }} {{ $productCharacteristic->value }} {{ $characteristic->postfix }}
                                    <input type="checkbox" name="characteristics[{{ $characteristic->id }}][]"
                                           value="{{ $productCharacteristic->value }}"
                                            @checked($characteristic->isChecked($productCharacteristic->value))
                                    >
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

        <div class="buttons">
            <a href="javascript:void(0)" class="btn_1" onclick="$(this).parents('form').submit()" rel="nofollow">
                @translate('Фільтр')
            </a>
            <a href="{{ url()->current() }}" class="btn_1 gray">
                @translate('Скинути')
            </a>
        </div>
    </form>
</div>
