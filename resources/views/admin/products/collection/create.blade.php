@extends('admin.layout')

@section('content')

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home">
            <form data-type="ajax"
                  data-after="close"
                  data-success-driver="toastr"
                  data-error-driver="toastr"
                  data-url="{{ route('admin.post', ['product', 'collection', 'create']) }}">
                <div class="form-group">
                    <label><i class="text-danger">*</i> Назва</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset(config('default.image.uk')) }}">
                                    </span>
                                </div>
                                <input name="name_uk" class="form-control">
                                <div class="feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset(config('default.image.ru')) }}">
                                    </span>
                                </div>
                                <input name="name_ru" class="form-control">
                                <div class="feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Псевдонім</label>
                    <input class="form-control" name="slug">
                    <div class="feedback"></div>
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Батьківська колекція</label>
                    <select name="parent_id" class="form-control">
                        @foreach($collections as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="feedback"></div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop