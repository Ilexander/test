<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\ApiDoc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiDocFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'title'         => Str::random(32),
            'description'   => Str::random(32),
            'response'      => json_encode(Str::random(32)),
        ];
    }

    protected function getModelClassName(): string
    {
        return ApiDoc::class;
    }

    /**
     * @param array $extra
     * @return Model|ApiDoc
     */
    public function create(array $extra = []): Model|ApiDoc
    {
        return parent::create($extra);
    }
}
