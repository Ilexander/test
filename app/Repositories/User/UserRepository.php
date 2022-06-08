<?php

namespace App\Repositories\User;

use App\Helpers\ArrayHelper;
use App\Http\Requests\User\UserAllInterface;
use App\Http\Requests\User\UserCreateInterface;
use App\Http\Requests\User\UserDeleteInterface;
use App\Http\Requests\User\UserInfoInterface;
use App\Http\Requests\User\UserUpdateInterface;
use App\Interfaces\Repositories\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all(UserAllInterface $all): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this
            ->user
            ->newQuery()
            ->select(
                'users.*',
                DB::raw('CONCAT_WS(" ", `last_name`, `first_name`) as `full_name`')
            )
            ->when($all->getRoleIdFilter(), function ($query, $role_id) {
                return $query->where('role_id', $role_id);
            })
            ->when($all->getApiKeyFilter(), function ($query, $api_key) {
                return $query->where('api_key', $api_key);
            })
            ->when($all->getEmailFilter(), function ($query, $email) {
                return $query->where('email', 'like', '%'. $email .'%');
            })
            ->when($all->getSortField(), function ($query, $sort) use ($all){
                return $query->orderBy($sort, ($all->getSortType() ?? 'desc'));
            })
            ->with(['lastSession', 'userPrice'])
//            ->when($all->getLimit(), function ($query, $limit) {
//                return $query->limit($limit);
//            })
            ->when($all->getFirstLastNameFilter(), function ($query, $name) {
                return $query->having('full_name', 'LIKE', '%' . $name . '%');
            })
            ->when($all->getSearchFilter(), function ($query, $search) {
                return $query
                    ->where('email', 'like', '%'. $search .'%')
                    ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%');
            })
            ->paginate($all->getLimit() ?? 25);
    }

    public function info(UserInfoInterface $info): Model
    {
        return $this->user->newQuery()->with(['roles', 'canceledPayments', 'userPrice'])->find($info->getId());
    }

    public function create(UserCreateInterface $create): Model
    {
        /** @var User $user */
        $user = new $this->user();
        $user->fill([
            "email"         => $create->getEmail(),
            "role_id"       => $create->getRoleId(),
           // "login_type",
            "first_name"    => $create->getFirstName(),
            "last_name"     => $create->getLastName(),
            "password"      => $create->getPassword(),
            "timezone"      => $create->getTimezone(),
        ]);
        $user->save();

        return $user;
    }

    public function delete(UserDeleteInterface $delete): bool
    {
        return $this->user->newQuery()->where('id', $delete->getId())->delete();
    }

    public function update(UserUpdateInterface $update): bool
    {
        $updateArray = ArrayHelper::filterEmpty([
            "email"         => $update->getEmail(),
            "role_id"       => $update->getRoleName()
                ? Role::query()->where('name', $update->getRoleName())->first()->id
                : $update->getRoleId(),
            "first_name"    => $update->getFirstName(),
            "last_name"     => $update->getLastName(),
            "timezone"      => $update->getTimezone(),
            "balance"       => (float)$update->getBalance(),
            "status"        => $update->getStatus(),
            "desc"          => $update->getDesc(),
            "image_file"    => $update->getImageUrl(),
            "more_information" => json_encode([
                "website" => $update->getMoreInformation()["website"] ?? "",
                "phone" => $update->getMoreInformation()["phone"] ?? "",
                "skype" => $update->getMoreInformation()["skype"] ?? "",
                "address" => $update->getMoreInformation()["address"] ?? "",
                "whatsapp_number" => $update->getMoreInformation()["whatsapp_number"] ?? "",
                "ignore_paypal_minimum_amount_sum" => $update->getMoreInformation()["ignore_paypal_minimum_amount_sum"] ?? "",
            ])
        ]);

        if ($update->getChangePassword()) {
            $updateArray["password"] = bcrypt($update->getChangePassword());
        }

        return $this
            ->user
            ->newQuery()
            ->where('id', $update->getId())
            ->update($updateArray);
    }

    public function list(): Collection
    {
        return $this->user->newQuery()->get();
    }
}
