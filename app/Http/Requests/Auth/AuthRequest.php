<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string emailAuth
 * @property string passwordAuth
 */
class AuthRequest extends FormRequest implements AuthInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        "emailAuth" => "string",
        "passwordAuth" => "string",
        // "g-recaptcha-response" => "string",
    ])]
    public function rules(): array
    {
        return [
            "emailAuth" => "required|email",
            "passwordAuth" => "required|string",
            // "g-recaptcha-response" => "required|recaptcha",
        ];
    }

    public function getEmail(): string
    {
        return $this->emailAuth;
    }

    public function getPassword(): string
    {
        return $this->passwordAuth;
    }
}
