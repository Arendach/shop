<?php

namespace App\Http\Controllers\Bridge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function section_main()
    {
        return view('bridge.main');
    }
}
