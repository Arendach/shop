@extends('bridge.layout')

@section('content')

    @if($success == true)
        @lang('bridge.characteristics_sync')
    @else
        @lang('bridge.characteristics_not_sync')
    @endif

@endsection('content')