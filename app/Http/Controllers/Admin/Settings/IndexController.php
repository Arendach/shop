<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class IndexController extends AdminController
{
    public function section_main()
    {
        $data = [
            'title'       => 'Налаштування',
            'breadcrumbs' => [['Налаштування']],
        ];

        return view('admin.settings.index.main', $data);
    }
}
