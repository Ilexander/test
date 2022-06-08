<?php

namespace App\Services\User;

use App\Models\BlockUser;

class BlockUserService
{
    /**
     * @param string $email
     * @return int
     */
    public function getTryCount(string $email): int
    {
        $res = BlockUser::query()
            ->where('email', $email)
            ->where('is_active', true)
            ->first();

        return $res ? $res->reset_count : 0;
    }

    /**
     * @param string $email
     * @return void
     */
    public function updateTryCount(string $email): void
    {
        $currentCount = $this->getTryCount($email);

        if ($currentCount > 0) {
            BlockUser::query()
                ->where('email', $email)
                ->where('is_active', true)
                ->update([
                    'reset_count' => ++$currentCount
                ]);
        } else {
            BlockUser::query()
                ->create([
                    'email'         => $email,
                    'reset_count'   => ++$currentCount,
                    'is_active'     => true,
                ]);
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    public function unblockUser(string $email): bool
    {
        return BlockUser::query()
            ->where('email', $email)
            ->where('is_active', true)
            ->delete();
    }
}
