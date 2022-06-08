<?php

namespace App\Services\Faq;

use App\Interfaces\Repositories\LanguageInterface;
use App\Interfaces\Repositories\TranslationInterface;
use App\Models\Faq;
use App\Repositories\Faq\FaqRepository;
use Illuminate\Support\ServiceProvider;

class FaqServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('faqService', function ($app) {
            return new FaqService(
                $app->make('App\Interfaces\Repositories\FaqInterface'),
                $app->make('App\Interfaces\Repositories\LanguageInterface'),
                $app->make('App\Interfaces\Repositories\TranslationInterface'),
            );
        });

        $this->app->bind('App\Interfaces\Repositories\FaqInterface', function ($app) {
            return new FaqRepository(new Faq());
        });
    }
}