<?php

namespace App\Repositories\Contracts;

interface BookRepositoryInterface
{
    public function search(?string $term = null, int $perPage = 10);
    public function create(array $data);
    public function find(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}
