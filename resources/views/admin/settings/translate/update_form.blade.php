@extends('admin.modal')

@section('content')

    <form data-type="ajax" data-url="{{ url('admin/settings/translate/update') }}">
        <input type="hidden" name="id" value="{{ $phrase->id }}">

        <div class="form-group">
            <label>@translate('Українською')</label>
            <input class="form-control" value="{{ $phrase->content_uk }}" name="content_uk">
        </div>

        <div class="form-group">
            <label>@translate('Російською')</label>
            <input class="form-control" value="{{ $phrase->content_ru }}" name="content_ru">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">@translate('Зберегти')</button>
        </div>
    </form>

@stop