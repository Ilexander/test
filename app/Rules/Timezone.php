<?php

namespace App\Rules;

use App\Services\TimeService;
use Illuminate\Contracts\Validation\Rule;

class Timezone implements Rule
{
    private TimeService $service;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(TimeService $service)
    {
        $this->service = $service;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->service->checkTimezone($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute should be valid timezone';
    }
}
