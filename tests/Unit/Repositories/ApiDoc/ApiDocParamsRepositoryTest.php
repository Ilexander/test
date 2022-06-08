<?php

namespace Tests\Unit\Repositories\ApiDoc;

use App\Http\Requests\Api\ApiDocParams\ApiDocParamsCreateRequest;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsDeleteRequest;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsListRequest;
use App\Models\ApiDocParams;
use App\Repositories\ApiDoc\ApiDocParamsRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\Factories\ApiDocFactory;
use Tests\Factories\ApiDocParamsFactory;
use Tests\TestCase;

class ApiDocParamsRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private ApiDocParams $apiDocParams;

    private ApiDocParamsRepository $apiDocParamsRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiDocParams = new ApiDocParams();

        $this->apiDocParamsRepository = new ApiDocParamsRepository($this->apiDocParams);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testList()
    {
        $apiDocParam = ApiDocParamsFactory::new()->create();
        $allToApiDoc = new ApiDocParamsListRequest();
        $allToApiDoc->merge([
            'api_doc_id' => $apiDocParam->api_doc_id
        ]);
        $result = $this->apiDocParamsRepository->list($allToApiDoc);

        /** @var ApiDocParams $item */
        foreach ($result as $item) {
            $this->assertEquals($apiDocParam->id, $item->id);
            $this->assertEquals($apiDocParam->api_doc_id, $item->api_doc_id);
            $this->assertEquals($apiDocParam->parameter, $item->parameter);
            $this->assertEquals($apiDocParam->description, $item->description);
        }

        $apiDocParamSecond = ApiDocParamsFactory::new()->create();

        $all = new ApiDocParamsListRequest();
        $result = $this->apiDocParamsRepository->list($all);

        /** @var ApiDocParams $item */
        foreach ($result as $item) {
            if ($item->id === $apiDocParamSecond->id) {
                $this->assertEquals($apiDocParamSecond->api_doc_id, $item->api_doc_id);
                $this->assertEquals($apiDocParamSecond->parameter, $item->parameter);
                $this->assertEquals($apiDocParamSecond->description, $item->description);
            }

            if ($item->id === $apiDocParam->id) {
                $this->assertEquals($apiDocParam->api_doc_id, $item->api_doc_id);
                $this->assertEquals($apiDocParam->parameter, $item->parameter);
                $this->assertEquals($apiDocParam->description, $item->description);
            }
        }

    }

    public function testCreate()
    {
        $apiDoc = ApiDocFactory::new()->create();

        $insertData = [
            "api_doc_id" => $apiDoc->id,
            "parameter" => Str::random(32),
            "description" => Str::random(32),
        ];

        $create = new ApiDocParamsCreateRequest();
        $create->merge($insertData);

        /** @var ApiDocParams $apiDocParam */
        $apiDocParam = $this->apiDocParamsRepository->create($create);

        $this->assertEquals($insertData['api_doc_id'], $apiDocParam->api_doc_id);
        $this->assertEquals($insertData['parameter'], $apiDocParam->parameter);
        $this->assertEquals($insertData['description'], $apiDocParam->description);
    }

    public function testDelete()
    {
        $apiDocParamFirst = ApiDocParamsFactory::new()->create();
        $apiDocParamSecond = ApiDocParamsFactory::new()->create();

        $all = new ApiDocParamsListRequest();
        $result = $this->apiDocParamsRepository->list($all);

        /** @var ApiDocParams $item */
        foreach ($result as $item) {
            if ($apiDocParamFirst->id === $item->id) {
                $this->assertEquals($apiDocParamFirst->api_doc_id, $item->api_doc_id);
                $this->assertEquals($apiDocParamFirst->parameter, $item->parameter);
                $this->assertEquals($apiDocParamFirst->description, $item->description);
            }

            if ($apiDocParamSecond->id === $item->id) {
                $this->assertEquals($apiDocParamSecond->api_doc_id, $item->api_doc_id);
                $this->assertEquals($apiDocParamSecond->parameter, $item->parameter);
                $this->assertEquals($apiDocParamSecond->description, $item->description);
            }
        }

        $delete = new ApiDocParamsDeleteRequest();
        $delete->merge([
            "id" => $apiDocParamFirst->id
        ]);
        $this->assertTrue($this->apiDocParamsRepository->delete($delete));

        $wasDeleted = true;
        $result = $this->apiDocParamsRepository->list($all);

        /** @var ApiDocParams $item */
        foreach ($result as $item) {
            if ($item->id === $apiDocParamFirst->id) {
                $wasDeleted = false;
            }
        }

        $this->assertTrue($wasDeleted);

        $delete = new ApiDocParamsDeleteRequest();
        $delete->merge([
            "api_doc_id" => $apiDocParamSecond->api_doc_id
        ]);
        $this->assertTrue($this->apiDocParamsRepository->delete($delete));

        $wasDeleted = true;
        $result = $this->apiDocParamsRepository->list($all);

        /** @var ApiDocParams $item */
        foreach ($result as $item) {
            if ($item->id === $apiDocParamSecond->id) {
                $wasDeleted = false;
            }
        }

        $this->assertTrue($wasDeleted);
    }
}
