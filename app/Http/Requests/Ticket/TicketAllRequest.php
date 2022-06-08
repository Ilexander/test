<?php

namespace App\Http\Requests\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

/**
 * Class TicketAllRequest
 * @package App\Http\Requests\Ticket
 *
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $search
 * @property int|null $filter_status
 * @property int|null $filter_important
 */
class TicketAllRequest extends FormRequest implements TicketAllInterface
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
            "search" => 'nullable|string',
            "filter_status" => 'nullable|in:'.implode(',', array_keys(Ticket::TICKET_STATUS_LIST)),
            "filter_important" => 'nullable|in:0,1',
            "start_date" => 'nullable|date_format:"Y-m-d"',
            "end_date" => 'nullable|date_format:"Y-m-d"',
        ];
    }

    public function getFilterImportant(): ?int
    {
        return $this->filter_important;
    }

    public function getFilterStatus(): ?int
    {
        return $this->filter_status;
    }

    public function getUserId(): ?int
    {
        return (Auth::user() && !Auth::user()->isAdmin()) ? Auth::user()->id : null;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getStartDate(): ?string
    {
        return $this->start_date;
    }

    public function getEndDate(): ?string
    {
        return $this->end_date;
    }
}
