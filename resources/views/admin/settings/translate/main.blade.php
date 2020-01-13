@extends('admin.layout')

@section('content')

    <table class="table table-bordered">
        <tr>
            <th>@translate('Оригінал')</th>
            <th>@translate('Українською')</th>
            <th>@translate('Російською')</th>
            <th>@translate('Дії')</th>
        </tr>
        @foreach($phrases as $phrase)
            <tr>
                <td>{{ $phrase->original }}</td>
                <td>{{ $phrase->content_uk }}</td>
                <td>{{ $phrase->content_ru }}</td>
                <td>
                    <button data-type="get_form"
                            data-url="{{ url('admin/settings/translate/update_form') }}"
                            data-post="{{ params(['id' => $phrase->id]) }}"
                            class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>

@stop
