@extends('admin.modal')

@section('content')

    <form data-url="{{ route('admin.post', ['product', 'product_image', 'update']) }}" data-type="ajax">
        <input type="hidden" name="id" value="{{ $image->id }}">
        <div class="form-group">
            <label>Альтернативний текст</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                        </div>
                        <input class="form-control form-control-sm" name="alt_uk" value="{{ $image->alt_uk }}">
                        <div class="feedback"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}">
                            </span>
                        </div>
                        <input class="form-control form-control-sm" name="alt_ru" value="{{ $image->alt_ru }}">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Пріоритет</label>
            <input class="form-control form-control-sm" name="priority" type="number" value="{{ $image->priority }}">
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>

@endsection('content')