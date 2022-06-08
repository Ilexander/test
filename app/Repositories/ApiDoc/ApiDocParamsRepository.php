<?php
//ApiDocParamsInterface

namespace App\Repositories\ApiDoc;

use App\Http\Requests\Api\ApiDocParams\ApiDocParamsCreateInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsDeleteInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsListInterface;
use App\Interfaces\Repositories\ApiDocParamsInterface;
use App\Models\ApiDocParams;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiDocParamsRepository implements ApiDocParamsInterface
{
    public function __construct(private ApiDocParams $apiDocParams)
    {}

    /**
     * @param ApiDocParamsListInterface $list
     * @return Collection
     */
    public function list(ApiDocParamsListInterface $list): Collection
    {
        return $this
            ->apiDocParams
            ->newQuery()
            ->when($list->getApiDocId(), function ($query, $apiDocId) {
                return $query->where('api_doc_id', $apiDocId);
            })
            ->get();
    }

    /**
     * @param ApiDocParamsCreateInterface $create
     * @return Model
     */
    public function create(ApiDocParamsCreateInterface $create): Model
    {
        /** @var ApiDocParams $apiDocParams */
        $apiDocParams = new $this->apiDocParams();
        $apiDocParams->fill([
            'api_doc_id'    => $create->getApiDocId(),
            'parameter'     => $create->getParameter(),
            'description'   => $create->getDescription(),
        ]);
        $apiDocParams->save();

        return $apiDocParams;
    }

    /**
     * @param ApiDocParamsDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiDocParamsDeleteInterface $delete): bool
    {
        return $this
            ->apiDocParams
            ->newQuery()
            ->when($delete->getId(), function ($query, $id) {
                return $query->where('id', $id);
            })
            ->when($delete->getApiDocId(), function ($query, $apiDocId) {
                return $query->where('api_doc_id', $apiDocId);
            })
            ->delete();
    }
}