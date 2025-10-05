<?php

namespace App\Repositories;

use App\Models\Subjects;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function pluck()
    {
        return Subjects::pluck('description', 'id');
    }

    public function search(?string $term = null, int $perPage = 10)
    {
        $query = Subjects::query();

        if ($term) {
            $query->where('description', 'like', '%' . $term . '%');
        }

        return $query->paginate($perPage);
    }

    public function create(array $data)
    {
        return Subjects::create($data);
    }

    public function find(int $id)
    {
        return Subjects::find($id);
    }

    public function update(int $id, array $data)
    {
        $author = Subjects::find($id);

        $author->fill($data);

        return $author->save();
    }

    public function delete(int $id)
    {
        $author = Subjects::find($id);

        return $author->delete();
    }
}
