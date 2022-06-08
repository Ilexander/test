<?php

namespace App\Http\Requests\User;

interface UserAllInterface
{
    public function getRoleIdFilter(): ?int;
    public function getApiKeyFilter(): ?string;
    public function getSortField(): ?string;
    public function getSortType(): ?string;
    public function getLimit(): ?int;
    public function getEmailFilter(): ?string;
    public function getFirstLastNameFilter(): ?string;
    public function getSearchFilter(): ?string;
}
