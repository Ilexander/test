<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\ApiDocParams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiDocParamsFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'api_doc_id'    => function() {
                return ApiDocFactory::new()->create()->id;
            },
            'parameter' => Str::random(32),
            'description' => Str::random(32),
        ];
    }

    protected function getModelClassName(): string
    {
        return ApiDocParams::class;
    }

    /**
     * @param array $extra
     * @return Model|ApiDocParams
     */
    public function create(array $extra = []): Model|ApiDocParams
    {
        return parent::create($extra);
    }
}
