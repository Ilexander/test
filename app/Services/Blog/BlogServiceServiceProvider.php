<?php

namespace App\Services\Blog;

use App\Interfaces\Repositories\LanguageInterface;
use App\Interfaces\Repositories\TranslationInterface;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepository;
use App\Services\Image\ImageService;
use Illuminate\Support\ServiceProvider;

class BlogServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('blogService', function ($app) {
            return new BlogService(
                $app->make('App\Interfaces\Repositories\BlogInterface'),
                new ImageService(),
                $app->make('App\Interfaces\Repositories\LanguageInterface'),
                $app->make('App\Interfaces\Repositories\TranslationInterface'),
            );
        });

        $this->app->bind('App\Interfaces\Repositories\BlogInterface', function ($app) {
            return new BlogRepository(new Blog());
        });
    }
}