<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\AbstractRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractService
{
    public function getRepository(): AbstractRepository
    {
        assert(property_exists($this, 'repository'));

        try {
            $this->repository->reset();

            return $this->repository;
        } catch (Exception $exception) {
            abort(Response::HTTP_BAD_REQUEST, $exception->getMessage());
        }
    }
}
