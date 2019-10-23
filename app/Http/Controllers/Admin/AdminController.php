<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use JavaScript;

class AdminController extends Controller
{
    public function __construct()
    {
        JavaScript::put([
            'deleteSuccessText' => __('common.delete.success_text'),
            'deleteSuccessTitle' => __('common.delete.success_title'),
            'deleteConfirmText' => __('common.delete.confirm_text'),
            'deleteConfirmTitle' => __('common.delete.confirm_title')
        ]);


        view()->share('controller', $this->controller_name());
    }

    private function controller_name()
    {
        $action = app('request')->route()->getAction();

        if (\Config::has('app.controller'))
            $action['controller'] = \Config::get('app.controller');

        $controller = class_basename($action['controller']);
        list($controller) = explode('@', $controller);
        $controller = Str::snake(str_replace('Controller', '', $controller));
        return ($controller);
    }
}
