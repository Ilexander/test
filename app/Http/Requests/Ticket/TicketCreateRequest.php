<?php

namespace App\Http\Requests\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class TicketCreateRequest
 * @package App\Http\Requests\Ticket
 *
 * @property string subject
 * @property string description
 * @property string|null orderId
 * @property string|null transactionId
 * @property string|null payment
 * @property string|null ticket_request
 */
class TicketCreateRequest extends FormRequest implements TicketCreateInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
        /** @var User $user */
        $user = Auth::user();

        return $user->hasPermissionTo(Ticket::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'subject' => 'required|string',
            'description' => 'required|string',
            'orderId' => 'nullable|string',
            'transactionId' => 'nullable|string',
            'payment' => 'nullable|string',
            'ticket_request' => 'nullable|string',
        ];
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function getRequest(): ?string
    {
        return $this->ticket_request;
    }
}
