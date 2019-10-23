@inject('pc', "App\\Models\\ProductCharacteristic")

@extends('admin.modal')

@section('content')

    <form data-type="ajax"
          data-error-driver="toastr"
          data-success-driver="sweetalert"
          data-after="reload"
          data-url="{{ route('admin.post', ['product', 'product_characteristics', 'create']) }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="form-group">
            <label>Характеристика</label>
            <select class="form-control form-control-sm" name="characteristic_id">
                @foreach($characteristics as $item)
                    @continue($pc->where('product_id', $product->id)->where('characteristic_id', $item->id)->count())

                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Значення</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.uk')) }}">
                            </span>
                        </div>
                        <input class="form-control form-control-sm" name="value_uk">
                        <div class="feedback"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset(config('default.image.ru')) }}">
                            </span>
                        </div>
                        <input class="form-control form-control-sm" name="value_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>

@endsection