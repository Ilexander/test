<?php

namespace App\Rules;

use App\Models\Service;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CheckMassOrder implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $orders = explode(PHP_EOL, $value);

        $formatOrders = [];

        foreach ($orders as $order) {
            $singleOrder = explode('|', $order);

            $formatOrders[] = [
                'service' => $singleOrder[0],
                'count' => $singleOrder[1],
                'link' => $singleOrder[2],
            ];

            if (
                count($singleOrder) < 3
                || !Service::query()->find($singleOrder[0])
                || !is_numeric($singleOrder[1])
                || strlen($singleOrder[2]) > 80
                || !str_contains($singleOrder[2], 'https://www.instagram.com/')
            ) {
                return false;
            }
        }

        $services = Service::query()
            ->whereIn('id', array_column($formatOrders, 'service'))
            ->with(['category'])
            ->get()
            ->keyBy('id');

        $finalAmount = 0;
        $wrongCount = false;
        $wrongLink = false;

        foreach ($formatOrders as $order) {

            if (
                $services[$order['service']]->category->name === 'Followers'
                && !preg_match(
                    '/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am|instagr.com)(?!\/p\/)(\/\w+)/',
                    $order['link']
                )
            ) {
                $wrongLink = true;
            }

            if (
                $services[$order['service']]->category->name === 'Likes'
                && !preg_match(
                    '/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am|instagr.com)(\/*p\/)(\w+)/',
                    $order['link']
                )
            ) {
                $wrongLink = true;
            }

            if (
                $order['count'] < $services[$order['service']]->min
                || $order['count'] > $services[$order['service']]->max
            ) {
                $wrongCount = true;
            }
            $finalAmount += ($services[$order['service']]->price * $order['count'] / 1000);
        }


        if (Auth::user()->balance <= $finalAmount || $wrongCount || $wrongLink) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
