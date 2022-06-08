<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Services\Image\ImageService;
use Illuminate\Support\ServiceProvider;

class CategoryServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('categoryService', function($app) {
            return new CategoryService(
                $app->make('App\Interfaces\Repositories\CategoryInterface'),
                new ImageService()
            );
        });

        $this->app->bind('App\Interfaces\Repositories\CategoryInterface', function($app) {
            return new CategoryRepository(new Category());
        });
    }
}