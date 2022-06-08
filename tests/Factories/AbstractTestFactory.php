<?php

declare(strict_types=1);

namespace Tests\Factories;

use ArgumentCountError;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractTestFactory
{
    protected Generator $faker;

    protected array $fields = [];

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    abstract protected function defaultFields(): array;

    abstract protected function getModelClassName(): string;

    /**
     * @param array $extra
     * @return Model
     */
    public function create(array $extra = []): Model
    {
        $this->fields = array_merge($this->defaultFields(), $this->fields, $extra);
        $className    = $this->getModelClassName();
        $model        = new $className();
        foreach ($this->fields as $field => $value) {
            if (is_callable($value)) {
                try {
                    $value = $value();
                } catch (ArgumentCountError $e) {
                    error_log("Error trying to call {$value} as function");
                }
            }
            $model->$field = $value;
        }
        $model->save();

        return $model;
    }

    /**
     * @return static
     */
    public static function new(): self
    {
        return new static();
    }

    public function createMany(int $qty, array $extra = []): Collection
    {
        $collection = new Collection();
        for ($i = 0; $i < $qty; $i++) {
            $collection->add($this->create($extra));
        }

        return $collection;
    }
}