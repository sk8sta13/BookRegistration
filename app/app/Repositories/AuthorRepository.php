<?php

namespace App\Repositories;

use App\Models\Authors;
use App\Repositories\Contracts\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function search(?string $term = null, int $perPage = 10)
    {
        $query = Authors::query();

        if ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        }

        return $query->paginate($perPage);
    }

    public function create(array $data)
    {
        return Authors::create($data);
    }

    public function find(int $id)
    {
        return Authors::find($id);
    }

    public function update(int $id, array $data)
    {
        $author = Authors::find($id);

        $author->fill($data);

        return $author->save();
    }

    public function delete(int $id)
    {
        $author = Authors::find($id);

        return $author->delete();
    }
}
