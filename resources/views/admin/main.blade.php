<?php

$menu = include base_path('assets/admin_menu.php');

?>


@extends('admin.layout')

@section('style')

    <style>

        h2.admin-main-h2_header{
            color: #f60;
            margin: 20px;
            font-family: cursive
        }

        .admin-main-links{
            display: block;
        }

        .admin-main-links a {
            display: inline-block;
            width: calc(20% - 14px);
            color: #37414a;
            height: auto;
            padding: 10px;
            text-align: center;
            font-size: 20px;
        }

        .admin-main-links a:hover {
            text-decoration: none;
            color: #F60;
            box-shadow: #f60 0 0 5px;
        }
    </style>

@endsection('style')



@section('content')

    @foreach($menu as $part => $links)
        <h2 class="admin-main-h2_header">{{ $part }}</h2>
        <div class="admin-main-links">
            @foreach($links as $link)
                <a {{ $link['url'] == '#' ? 'disabled' : '' }} href="{{ $link['url'] }}">
                    <img src="{{ asset('adm/icons/' . $link['icon'] . '.png') }}" alt="{{ $link['icon'] }}"> <br>
                    {{ $link['text'] }}
                </a>
            @endforeach
        </div>
    @endforeach

@endsection
