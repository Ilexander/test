<?php

namespace App\Services\Translation;

use App\Models\Translation;
use App\Repositories\Translation\TranslationRepository;
use Illuminate\Support\ServiceProvider;

class TranslationServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('translationService', function ($app) {
            return new TranslationService(
                $app->make('App\Interfaces\Repositories\TranslationInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\TranslationInterface', function ($app) {
            return new TranslationRepository(new Translation());
        });
    }
}
