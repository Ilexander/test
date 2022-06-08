<?php

namespace App\Repositories\ApiDoc;

use App\Helpers\ArrayHelper;
use App\Http\Requests\Api\ApiDocs\ApiDocsAllInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsCreateInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsDeleteInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsInfoInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsUpdateInterface;
use App\Interfaces\Repositories\ApiDocInterface;
use App\Models\ApiDoc;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiDocRepository implements ApiDocInterface
{
    private ApiDoc $apiDoc;

    /**
     * @param ApiDoc $apiDoc
     */
    public function __construct(ApiDoc $apiDoc)
    {
        $this->apiDoc = $apiDoc;
    }

    /**
     * @param ApiDocsAllInterface $all
     * @return Collection
     */
    public function list(ApiDocsAllInterface $all): Collection
    {
        return $this->apiDoc->newQuery()->with(['params'])->get();
    }

    /**
     * @param ApiDocsCreateInterface $create
     * @return Model
     */
    public function create(ApiDocsCreateInterface $create): Model
    {
        /** @var ApiDoc $apiDoc */
        $apiDoc = new $this->apiDoc();
        $apiDoc->fill(ArrayHelper::filterEmpty(
            [
                'title'         => $create->getTitle(),
                'description'   => $create->getDescription(),
                'response'      => json_encode($create->getResponse()),
            ]
        ));
        $apiDoc->save();

        return $apiDoc;
    }

    /**
     * @param ApiDocsInfoInterface $info
     * @return Model|null
     */
    public function info(ApiDocsInfoInterface $info): ?Model
    {
        return $this->apiDoc->newQuery()->with(['params'])->find($info->getId());
    }

    /**
     * @param ApiDocsUpdateInterface $update
     * @return bool
     */
    public function update(ApiDocsUpdateInterface $update): bool
    {
        return $this
            ->apiDoc
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                'title'         => $update->getTitle(),
                'description'   => $update->getDescription(),
                'response'      => json_encode($update->getResponse()),
            ]);
    }

    /**
     * @param ApiDocsDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiDocsDeleteInterface $delete): bool
    {
        return $this
            ->apiDoc
            ->newQuery()
            ->where('id', $delete->getId())
            ->delete();
    }
}
