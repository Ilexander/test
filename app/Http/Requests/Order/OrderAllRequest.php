<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property string $start_date
 * @property string $end_date
 * @property string|null $sort_field
 * @property string|null $sort_type
 * @property int|null $limit
 * @property int|null $user_id
 * @property array|null $id
 * @property string|null $status
 * @property string|null $search_field
 * @property string|null $search
 */
class OrderAllRequest extends FormRequest implements OrderAllInterface
{
    private bool $is_drip_feed = false;
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

        return $user->hasPermissionTo(Order::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"            => 'nullable|array',
            "id.*"          => 'nullable|numeric|min:1',
            "user_id"       => 'nullable|exists:users,id',
            "start_date"    => 'nullable|date_format:"Y-m-d"',
            "end_date"      => 'nullable|date_format:"Y-m-d"',
            "sort_field"    => "nullable|in:id,created_at,".implode(',',(new Order())->getFillable()),
            "sort_type"     => "nullable|in:asc,desc",
            "limit"         => "nullable|numeric|min:1",
            "status"        => 'nullable|in:'.implode(',', Order::ORDER_STATUS_LIST),
            "search_field"  => 'nullable',
            "search"        => 'nullable|required_with:search_field',
        ];
    }

    /**
     * @return string|null
     */
    public function getSearchField(): ?string
    {
        return $this->search_field;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getId(): ?array
    {
        return $this->id;
    }

    public function getStartDate(): ?string
    {
        return $this->start_date;
    }

    public function getEndDate(): ?string
    {
        return $this->end_date;
    }

    public function getSortField(): ?string
    {
        return $this->sort_field;
    }

    public function getSortType(): ?string
    {
        return $this->sort_type;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @return bool
     */
    public function isIsDripFeed(): bool
    {
        return $this->is_drip_feed;
    }

    /**
     * @param bool $is_drip_feed
     */
    public function setIsDripFeed(bool $is_drip_feed): void
    {
        $this->is_drip_feed = $is_drip_feed;
    }
}
