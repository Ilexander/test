<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string|null $link
 * @property string|null $status
 * @property string|null $start_counter
 * @property string|null $remains
 * @property int|null $runs
 * @property int|null $interval
 */
class OrderUpdateRequest extends FormRequest implements OrderUpdateInterface
{
    private ?int $user_id = null;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->user_id = Auth::user()->id ?? null;
    }

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
            "id"                    => 'required|exists:orders,id',
            "link"                  => 'nullable',
            "status"                => 'nullable|in:'.implode(',', Order::ORDER_USER_STATUS_LIST),
            "start_counter"         => 'nullable',
            "remains"               => 'nullable',
            "runs"                  => 'nullable|numeric|min:1',
            "interval"              => 'nullable|numeric|min:1'
        ];
    }

    protected function prepareForValidation()
    {
        if (is_numeric($this->status)) {
            $this->merge([
                'status' => Order::ORDER_USER_STATUS_LIST[$this->status],
            ]);
        }
    }

    public function setUserId(?int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function getRuns(): ?int
    {
        return $this->runs;
    }

    public function getInterval(): ?int
    {
        return $this->interval;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
       return $this->user_id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getStartCounter(): ?string
    {
        return $this->start_counter;
    }

    public function getRemains(): ?string
    {
        return $this->remains;
    }
}
