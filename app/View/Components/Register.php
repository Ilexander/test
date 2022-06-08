<?php

namespace App\View\Components;

use App\Services\TimeService;
use Illuminate\View\Component;

class Register extends Component
{
    private TimeService $service;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(TimeService $service)
    {
        $this->service = $service;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.register', [
            'timezoneList' => $this->service->getTimezoneList()
        ]);
    }
}
