<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class PaymentServerAuthorizationException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage()
        ]);
    }
}
