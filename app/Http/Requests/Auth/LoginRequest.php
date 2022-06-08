<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Auth
 *
 *
 * @property bool|null autologin
 * @property string|null emailAuth
 * @property string|null passwordAuth
 */
class LoginRequest extends FormRequest implements LoginInterface
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
        "autologin" => "string",
        "emailAuth" => "string",
        "passwordAuth" => "string"
    ])]
    public function rules(): array
    {
        return [
            "autologin" => "nullable|boolean",
            "emailAuth" => "required_if:autologin,true|email",
            "passwordAuth" => "required_if:autologin,true|string",
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->autologin)) {
            $this->merge([
                'autologin' => json_decode($this->autologin),
            ]);
        }
    }

    public function getAutologin(): ?bool
    {
        return $this->autologin;
    }

    public function getEmail(): ?string
    {
        return $this->emailAuth;
    }

    public function getPassword(): ?string
    {
        return $this->passwordAuth;
    }
}
