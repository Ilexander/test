<?php

namespace App\Rules;

use App\Http\Requests\Service\ServiceInfoRequest;
use App\Services\Service\ServiceFacade;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class OrderQuantity implements Rule
{
    private ?int $service_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?int $service_id)
    {
        $this->service_id = $service_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if ($this->service_id) {
            $info = new ServiceInfoRequest();
            $info->merge([
                'id' => $this->service_id
            ]);

            $service = ServiceFacade::info($info);

            if (
                $service->min <= (int)$value
                && (int)$value <= $service->max
                && ($value * $service->price / 1000) < Auth::user()->balance
            ) {

                return true;
            }
        }


        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'quantity is incorrect or you have low balance';
    }
}
