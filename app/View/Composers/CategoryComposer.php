<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Services\CategoryService;

class CategoryComposer
{
    protected $categories;

    public function __construct(CategoryService $categories)
    {
        $this->categories = $categories;
    }

    public function compose(View $view)
    {
        $categories = $this->categories->getAll();
        
        $view->with(compact('categories'));
    }
}