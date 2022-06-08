<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;
use App\Models\Language as LanguageModel;

class Orientation extends Component
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
        $language = LanguageModel::query()->where('alt', 'like', Config::get('app.locale'))->first();

        return view('components.orientation', [
            'orientation' => $language ? $language->view : 'ltr'
        ]);
    }
}
