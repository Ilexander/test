<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Api\ApiDocs\ApiDocsAllInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsCreateInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsDeleteInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsInfoInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ApiDocInterface
{
    /**
     * @param ApiDocsAllInterface $all
     * @return Collection
     */
    public function list(ApiDocsAllInterface $all): Collection;

    /**
     * @param ApiDocsCreateInterface $create
     * @return Model
     */
    public function create(ApiDocsCreateInterface $create): Model;

    /**
     * @param ApiDocsInfoInterface $info
     * @return Model|null
     */
    public function info(ApiDocsInfoInterface $info): ?Model;

    /**
     * @param ApiDocsUpdateInterface $update
     * @return bool
     */
    public function update(ApiDocsUpdateInterface $update): bool;

    /**
     * @param ApiDocsDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiDocsDeleteInterface $delete): bool;
}
