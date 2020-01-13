@extends('catalog.layout')

@section('style')

    <link rel="stylesheet" href="{{ asset('catalog/css/products.css') }}">

    <style>
        .filter {
            padding: 10px;
            box-shadow: 0 0 10px #ccc;
            margin-top: 15px;
        }

        .order-by {
            padding: 10px;
            box-shadow: 0 0 10px #ccc;
            margin-top: 15px;
        }

        .filter-price {
            display: flex;
        }

        .filter h3 {
            color: #e31837;
            border-bottom: 1px solid #e31837;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3">


                <div class="filter">
                    <h3>@translate('Фільтр')</h3>

                    <label><b>@translate('Ціна'):</b></label>
                    <div class="filter-price">
                        <div>
                            <input id="min_price" class="form-control form-control-sm"
                                   value="{{ $requestFields['min_price'] ?? $filter['min_price'] }}">
                        </div>

                        <div>
                            <input id="max_price" class="form-control form-control-sm"
                                   value="{{ $requestFields['max_price'] ?? $filter['max_price'] }}">
                        </div>

                        <div>
                            <button class="btn btn-primary btn-sm filter_products">Ok</button>
                        </div>
                    </div>

                    <hr>

                    <label><b>@translate('Виробник'):</b></label>
                    <div class="filter-manufacturers">
                        @foreach($filter['manufacturers'] as $item)
                            <label>
                                <input {{ isset($requestFields['manufacturers']) && in_array($item['id'], $requestFields['manufacturers']) ? 'checked' : '' }}
                                       class="manufacturer"
                                       value="{{ $item['id'] }}"
                                       type="checkbox">

                                {{ $item['name_' . config('locale.current')] }}
                            </label> <br>
                        @endforeach
                    </div>

                    <hr>

                    @foreach($filter['characteristics'] as $k => $item)
                        <div class="characteristics">
                            <label class="characteristic_id" data-value="{{ $item['id'] }}">
                                <b>
                                    {{ $item['name_' . config('locale.current')] }}:
                                </b>
                            </label>

                            <br>

                            @foreach($item['values'] as $v => $value)
                                <label>
                                    <input {{ isset($requestFields['ch_' . $item['id']]) && in_array($value['value_' . config('locale.current')], $requestFields['ch_' . $item['id']]) ? 'checked' : '' }}
                                           class="characteristic_flag"
                                           value="{{ $value['value_' . config('locale.current')] }}"
                                           type="checkbox"> {{ $value['value_' . config('locale.current')] }}
                                </label> <br>
                            @endforeach

                            <hr>
                        </div>

                    @endforeach

                    <button class="btn btn-primary filter_products">
                        @translate('Фільтрувати')
                    </button>

                </div>

            </div>
            <div class="col-9">

                <div class="order-by">
                    <div class="row">
                        <div class="col-6">
                            <label>
                                @translate('Сортування'):
                            </label>
                            <select class="form-control form-control-sm order" onchange="filterProducts()">
                                <option {{ isset($requestFields['order']) && $requestFields['order'] == 'date,desc' ? 'selected' : '' }}
                                        value="date,desc">
                                    @translate('Новинки')
                                </option>

                                <option {{ isset($requestFields['order']) && $requestFields['order'] == 'rating,desc' ? 'selected' : '' }}
                                        value="rating,desc">
                                    @translate('За рейтингом')
                                </option>

                                <option {{ isset($requestFields['order']) && $requestFields['order'] == 'price,desc' ? 'selected' : '' }}
                                        value="price,desc">
                                    @translate('Від дорогих до дешевих')
                                </option>

                                <option {{ isset($requestFields['order']) && $requestFields['order'] == 'price,asc' ? 'selected' : '' }}
                                        value="price,asc">
                                    @translate('Від дешевих до дорогих')
                                </option>
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="">
                                @translate('Показувати по'):
                            </label>
                            <select onchange="filterProducts()" class="form-control form-control-sm items">
                                <option {{ Request::get('items', null) == 20 ? 'selected' : '' }} value="20">
                                    20
                                </option>

                                <option {{ Request::get('items', null) == 50 ? 'selected' : '' }} value="50">
                                    50
                                </option>

                                <option {{ Request::get('items', null) == 70 ? 'selected' : '' }} value="70">
                                    70
                                </option>

                                <option {{ Request::get('items', null) == 100 ? 'selected' : '' }} value="100">
                                    100
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="products">
                    @forelse($products->chunk(3) as $chunk)
                        <div class="row" style="margin-bottom: 30px">
                            @foreach($chunk as $item)
                                @include('catalog.product.chunk', ['item' => $item, 'chunks' => 4])
                            @endforeach
                        </div>
                    @empty
                        <h4 class="centered">@translate('Тут порожньо')</h4>
                    @endforelse

                    {{ $products->links('catalog.pagination.default') }}

                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <script>

        function filterProducts() {
            let max_price = '{{ $filter['max_price'] }}';
            let min_price = '{{ $filter['min_price'] }}';

            ///////////////////////////////////////////////////////////
            let characteristics = {};

            $('.characteristics').each(function () {
                let $this = $(this);
                let id = $this.find('.characteristic_id').data('value');

                $this.find('.characteristic_flag:checked').each(function () {
                    if (typeof characteristics['ch_' + id] == 'undefined')
                        characteristics['ch_' + id] = [];

                    characteristics['ch_' + id].push($(this).val());
                });
            });

            let p = '';

            if (Object.keys(characteristics).length > 0) {
                for (let id in characteristics) {
                    for (let i in characteristics[id])
                        p += id + '[]=' + encodeURI(characteristics[id][i]) + '&';
                }
            }
            /////////////////////////////////////////////////////////////

            if ($('#min_price').val() != min_price)
                p += 'min_price=' + $('#min_price').val() + '&';


            if ($('#max_price').val() != max_price)
                p += 'max_price=' + $('#max_price').val() + '&';
            ///////////////////////////////////////////////////////////

            let manufacturers = [];
            $('.manufacturer:checked').each(function () {
                manufacturers.push($(this).val());
            });

            if (manufacturers.length > 0)
                for (let i in manufacturers)
                    p += 'manufacturers[]=' + manufacturers[i] + '&';

            ////////////////////////////////////////////////////////////
            p += 'order=' + $('.order').val() + '&';
            p += 'items=' + $('.items').val();

            window.location.href = '{{ url()->current() }}' + '?' + p;
        }

        $(document).on('click', '.filter_products', filterProducts);
    </script>

    @include('catalog.assets.cart_scripts')

@endsection