<?php

namespace App\Http\Composers;

use App\Models\Category;
use App\Models\ProductCollection;
use App\Models\Question;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;


class QuestionComposer
{
    public function compose(View $view)
    {
        if (Request::route()->getName() == 'category.show' && Request::route()->parameter('slug')) {
            $questions = Category::where('slug', Request::route()->parameter('slug'))
                ->first()
                ->questions()
                ->where('is_category', true)
                ->limit(4)
                ->get();
        } elseif (Request::route()->getName() == 'collection') {
            $questions = ProductCollection::where('slug', Request::route()->parameter('slug'))
                ->first()
                ->questions()
                ->where('is_collection', true)
                ->limit(4)
                ->get();
        } elseif (Request::route()->getName() == 'index') {
            $questions = Question::where('is_home', true)->get();
        } else {
            $questions = Question::where('is_other', true)->get();
        }

        $view->with(compact('questions'));
    }
}