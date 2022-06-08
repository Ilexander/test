<?php

namespace App\View\Components;

use App\Models\Settings;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavBar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private Collection $tickets)
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
        $mainTenance = Settings::query()->where('field_name','main_tenance_mode')->first();

        return view('components.nav-bar', [
            "user"  => Auth::user(),
            "mainTenance" => $mainTenance,
            'count' => $this->tickets->count()
        ]);
    }
}
