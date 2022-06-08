<?php

namespace App\Services\Language;

use App\Models\Language;
use App\Repositories\Language\LanguageRepository;
use App\Services\Image\ImageService;
use Illuminate\Support\ServiceProvider;

class LanguageServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('languageService', function ($app){
            return new LanguageService(
                $app->make('App\Interfaces\Repositories\LanguageInterface'),
                new ImageService()
            );
        });

        $this->app->bind('App\Interfaces\Repositories\LanguageInterface', function ($app){
            return new LanguageRepository(new Language());
        });

    }
}