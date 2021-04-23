<?php

namespace App\Http\Composers;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Config;

class ActionInfoComposer
{
    public function compose(View $view)
    {
        $controller = $this->getControllerName();

        $view->with('controller', $controller);
    }

    private function getControllerName()
    {
        $action = app('request')->route()->getAction();

        if (Config::has('app.controller')) {
            $action['controller'] = Config::get('app.controller');
        }

        $controller = class_basename($action['controller']);
        list($controller) = explode('@', $controller);
        $controller = Str::snake(str_replace('Controller', '', $controller));
        return ($controller);

    }
}