<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Category;
use App\Models\CategoryLink;
use App\Models\Menu;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    public function __construct()
    {
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

    protected function blade($name, $data = [])
    {
        if (\Agent::isDesktop()) $type = 'catalog';
        else $type = 'mobile';

        return view("$type.$name", $data);
    }
}
