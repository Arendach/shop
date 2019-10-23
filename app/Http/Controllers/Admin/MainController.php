<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class MainController extends AdminController
{
    public function index()
    {
        $data = [
            'title' => 'Адмінка'
        ];

        return view('admin.main', $data);
    }

    public function javascript()
    {
        header('Content-Type: text/javascript');

        return view('admin.javascript');
    }
}
