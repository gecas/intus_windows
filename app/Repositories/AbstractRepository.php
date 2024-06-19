<?php

declare(strict_types=1);

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class AbstractRepository
{
    abstract public function modelClass(): string;
    /**
     * @throws Exception
     */
    public function __construct(
        public Builder            $builder,
        private readonly ?Builder $persistedBuilder = null,
    ) {
    }
    public function getBuilder(): Builder
    {
        try {
            if (!$this->builder->getQuery()->from) {
                $this->builder = ($this->modelClass())::query();
            }

            return $this->builder;
        } catch (Exception $exception) {
            abort(ResponseAlias::HTTP_BAD_REQUEST, $exception->getMessage());
        }
    }

    public function reset(): self
    {
        if ($this->persistedBuilder) {
            $this->builder = clone $this->persistedBuilder;

            return $this;
        }

        $this->builder = $this->getBuilder();

        return $this;
    }

    /**
     * @param array<string> $attributes
     * @return Builder|Model
     */
    public function create(array $attributes): Builder|Model
    {
        return $this->getBuilder()->create($attributes);
    }

    /**
     * @return mixed
     */
    public function get(): mixed
    {
        $result = $this->getBuilder()->get();

        if (!($result instanceof Collection)) {
            throw new \RuntimeException('Expected Builder::get() to return an instance of Collection');
        }

        return $result;
    }
}
