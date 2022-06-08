<?php

namespace App\View\Components;

use App\Http\Requests\Language\LanguageAllRequest;
use App\Services\Language\LanguageFacade;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;

class Language extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.language', [
            'languages' => LanguageFacade::all(new LanguageAllRequest()),
            'current_language' => strtoupper(Config::get('language.current'))
        ]);
    }
}
