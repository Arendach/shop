@extends('admin.modal')

@section('content')

    <form data-type="ajax" data-url="{{ route('admin.post', ['product', 'product_characteristics', 'update']) }}">
        <input type="hidden" name="id" value="{{ $characteristic->id }}">

        <div class="form-group">
            <label>{{ $characteristic->characteristic->name .' ('.  $characteristic->characteristic->postfix .  ')' }}</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                        </div>
                        <input class="form-control form-control-sm" name="value_uk" value="{{ $characteristic->value_uk }}">
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
                        <input class="form-control form-control-sm" name="value_ru" value="{{ $characteristic->value_ru }}">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>

@endsection('content')