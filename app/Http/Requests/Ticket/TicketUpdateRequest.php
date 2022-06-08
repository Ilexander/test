<?php

namespace App\Http\Requests\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class TicketUpdateRequest
 * @package App\Http\Requests\Ticket
 *
 *  @property int id
 *  @property string subject
 *  @property string description
 */
class TicketUpdateRequest extends FormRequest implements TicketUpdateInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
    public function rules()
    {
        return [
            'id' => 'required|exists:tickets,id',
            'subject' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return Auth::user() ? Auth::user()->id : 0;
    }
}
