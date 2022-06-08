<?php

namespace App\Http\Requests\TicketMessage;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int ticket_id
 */
class TicketChatRequest extends FormRequest implements TicketMessageTicketInterface
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
    #[ArrayShape(['ticket_id' => "string"])]
    public function rules(): array
    {
        return [
            'ticket_id' => 'required|exists:tickets,id',
        ];
    }

    public function getTicketId(): int
    {
        return $this->ticket_id;
    }
}
