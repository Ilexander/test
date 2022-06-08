<?php

namespace App\Services\User;

use App\DTO\User\UserCanceledPaymentCollectionDTO;
use App\DTO\User\UserCanceledPaymentDTO;
use App\DTO\User\UserPersonalPriceCollectionDTO;
use App\DTO\User\UserPersonalPriceDTO;
use App\Http\Requests\Payment\PaymentInfoRequest;
use App\Http\Requests\Role\RoleInfoInterface;
use App\Http\Requests\Role\RoleInfoRequest;
use App\Http\Requests\User\UserAllInterface;
use App\Http\Requests\User\UserCreateInterface;
use App\Http\Requests\User\UserDeleteInterface;
use App\Http\Requests\User\UserInfoInterface;
use App\Http\Requests\User\UserInfoRequest;
use App\Http\Requests\User\UserUpdateInterface;
use App\Interfaces\Repositories\UserInterface;
use App\Models\User;
use App\Services\Payment\PaymentFacade;
use App\Services\Role\RoleFacade;
use App\Services\UserPrice\UserPriceFacade;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserService
{
    private UserInterface $repo;

    public function __construct(UserInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param UserInfoInterface $info
     * @return Model
     */
    public function info(UserInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    public function list(): Collection
    {
        return $this->repo->list();
    }

    /**
     * @param UserAllInterface $all
     * @return LengthAwarePaginator
     */
    public function all(UserAllInterface $all): LengthAwarePaginator
    {
        return $this->repo->all($all);
    }

    /**
     * @param UserCreateInterface $create
     * @param RoleInfoInterface $info
     * @return Model
     */
    public function create(UserCreateInterface $create, RoleInfoInterface $info): Model
    {
        /** @var User $user */
        $user = $this->repo->create($create);
        $user->assignRole((RoleFacade::info($info))->name);

        UserCanceledPaymentFacade::deleteForUser($user->id);

        if (!empty(array_unique($create->getPayments()))) {
            $this->addCanceledPayments(array_unique($create->getPayments()), $user);
        }

        UserPriceFacade::deletePricesByUserId($user->id);

        if (!empty($create->getServices())) {
            $this->addPersonalPrices($create->getServices(), $user);
        }

        return $user;
    }

    /**
     * @param UserUpdateInterface $update
     * @param RoleInfoInterface $info
     * @return bool
     */
    public function update(UserUpdateInterface $update, RoleInfoInterface $info): bool
    {
        if ($update->getAvatar()) {
            $file = $update->getAvatar();

            $prefix = Str::snake(Carbon::now()->format('Y-m-d_H:i'));

            Storage::disk('public_uploads')
                ->putFileAs('/setting/upload/uploads/logoPhotos/', $file, $prefix .'_'. $file->getClientOriginalName());

            $update->setImageUrl(
                url('/') . '/setting/upload/uploads/logoPhotos/' . $prefix .'_'. $file->getClientOriginalName()
            );
        }

        $userInfo = new UserInfoRequest();
        $userInfo->merge([
            'id' => $update->getId()
        ]);

        /** @var User $user */
        $user = UserFacade::info($userInfo);

        if ($user->roles->first()) {
            $user->removeRole($user->roles->first()->name);
        }

        $user->assignRole((RoleFacade::info($info))->name);

        UserCanceledPaymentFacade::deleteForUser($update->getId());

        if ($update->getPayments() && !empty(array_unique($update->getPayments()))) {
            $this->addCanceledPayments(array_unique($update->getPayments()), $user);
        }

        UserPriceFacade::deletePricesByUserId($user->id);

        if ($update->getServices() && !empty($update->getServices())) {
            $this->addPersonalPrices($update->getServices(), $user);
        }

        return $this->repo->update($update);
    }

    /**
     * @param UserDeleteInterface $delete
     * @return bool
     */
    public function delete(UserDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    private function addPersonalPrices(array $personalPricesList, User $user)
    {
        $personalPrices = new UserPersonalPriceCollectionDTO();

        $unique = [];

        foreach ($personalPricesList as $personalPrice) {
            if (!in_array($personalPrice['service'], $unique)) {
                $infoPrice = new UserPersonalPriceDTO(
                    $user->id,
                    $personalPrice['service'],
                    $personalPrice['priceValue']
                );

                $personalPrices->setItem($infoPrice);

                $unique[] = $personalPrice['service'];
            }
        }

        UserPriceFacade::create($personalPrices);
    }

    private function addCanceledPayments(array $canceledPaymentsList, User $user)
    {
        $canceledPayments = new UserCanceledPaymentCollectionDTO();

        foreach ($canceledPaymentsList as $payment){
            $infoPayment = new PaymentInfoRequest();
            $infoPayment->merge([
                'id' => $payment
            ]);
            $canceledPayments->setItem(
                new UserCanceledPaymentDTO($user, PaymentFacade::info($infoPayment))
            );
        }

        UserCanceledPaymentFacade::create($canceledPayments);
    }
}
