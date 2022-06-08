<?php

namespace App\Http\Requests\Transaction;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int id
 */
class TransactionDeleteRequest extends FormRequest implements TransactionDeleteInterface
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

        return $user->hasPermissionTo(Transaction::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:transactions,id',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
