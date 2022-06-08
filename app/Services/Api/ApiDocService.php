<?php

namespace App\Services\Api;

use App\Http\Requests\Api\ApiDocParams\ApiDocParamsCreateRequest;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsDeleteRequest;
use App\Http\Requests\Api\ApiDocs\ApiDocsAllInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsCreateInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsDeleteInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsInfoInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsUpdateInterface;
use App\Interfaces\Repositories\ApiDocInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiDocService
{
    private ApiDocInterface $repo;

    /**
     * @param ApiDocInterface $repo
     */
    public function __construct(ApiDocInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param ApiDocsAllInterface $list
     * @return Collection
     */
    public function list(ApiDocsAllInterface $list): Collection
    {
        return $this->repo->list($list);
    }

    /**
     * @param ApiDocsInfoInterface $info
     * @return Model|null
     */
    public function info(ApiDocsInfoInterface $info): ?Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param ApiDocsCreateInterface $create
     * @return Model
     */
    public function create(ApiDocsCreateInterface $create): Model
    {
        $apiDoc = $this->repo->create($create);

        if ($create->getRequestParams()) {
            $delete = new ApiDocParamsDeleteRequest();
            $delete->merge([
                'api_doc_id' => $apiDoc->id
            ]);

            ApiDocParamsFacade::delete($delete);

            foreach ($create->getRequestParams() as $params) {
                $create = new ApiDocParamsCreateRequest();
                $create->merge([
                    "api_doc_id"    => $apiDoc->id,
                    "parameter"     => $params['parameter'],
                    "description"   => $params['description']
                ]);

                ApiDocParamsFacade::create($create);
            }
        }

        return $apiDoc;
    }

    /**
     * @param ApiDocsUpdateInterface $update
     * @return bool
     */
    public function update(ApiDocsUpdateInterface $update): bool
    {
        if ($update->getRequestParams()) {
            $delete = new ApiDocParamsDeleteRequest();
            $delete->merge([
                'api_doc_id' => $update->getId()
            ]);

            ApiDocParamsFacade::delete($delete);

            foreach ($update->getRequestParams() as $params) {
                $create = new ApiDocParamsCreateRequest();
                $create->merge([
                    "api_doc_id"    => $update->getId(),
                    "parameter"     => $params['parameter'],
                    "description"   => $params['description']
                ]);

                ApiDocParamsFacade::create($create);
            }
        }

        return $this->repo->update($update);
    }

    /**
     * @param ApiDocsDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiDocsDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }
}
