<?php

namespace App\Http\Requests\Ticket;

use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int id
 * @property int ticket_id
 */
class TicketStatusUpdateRequest extends FormRequest implements TicketStatusUpdateInterface
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
        'id' => "string",
        "ticket_id" => "string"
    ])]
    public function rules(): array
    {
        return [
            'id'            => 'required|exists:tickets,id',
            "ticket_id"     => 'required|in:'.implode(',', array_keys(Ticket::TICKET_CHECK_STATUS_LIST)),
        ];
    }

    protected function prepareForValidation()
    {
        if (Auth::user()->isAdmin() && $this->ticket_id == Ticket::ANSWERED_STATUS) {
            $this->merge([
                'ticket_id' => Ticket::WAIT_FOR_USER_ANSWER,
            ]);
        }

        if (Auth::user()->isAdmin() && $this->ticket_id == Ticket::UNREAD_STATUS) {
            $this->merge([
                'ticket_id' => Ticket::WAIT_FOR_ADMIN_ANSWER,
            ]);
        }

        if (!Auth::user()->isAdmin() && $this->ticket_id == Ticket::ANSWERED_STATUS) {
            $this->merge([
                'ticket_id' => Ticket::WAIT_FOR_ADMIN_ANSWER,
            ]);
        }

        if (!Auth::user()->isAdmin() && $this->ticket_id == Ticket::UNREAD_STATUS) {
            $this->merge([
                'ticket_id' => Ticket::WAIT_FOR_USER_ANSWER,
            ]);
        }
    }

    public function getTicketId(): int
    {
        return $this->id;
    }

    public function getStatusId(): int
    {
        return $this->ticket_id;
    }
}
