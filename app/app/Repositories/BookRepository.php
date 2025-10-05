<?php

namespace App\Repositories;

use App\Models\Books;
use App\Repositories\Contracts\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function search(?string $term = null, int $perPage = 10)
    {
        $query = Books::query();

        if ($term) {
            $query->where('title', 'like', '%' . $term . '%')
                ->orwhere('publisher', 'like', '%' . $term . '%')
                ->orWhere('edition', 'like', '%' . $term . '%');
        }

        return $query->paginate($perPage);
    }

    public function create(array $data)
    {
        $book = Books::create($data);
        $book->Authors()->sync($data['author_id'] ?? []);
        $book->Subjects()->sync($data['subject_id'] ?? []);

        return $book;
    }

    public function find(int $id)
    {
        return Books::find($id);
    }

    public function update(int $id, array $data)
    {
        $book = Books::find($id);
        $book->update($data);
        $book->Authors()->sync($data['author_id'] ?? []);
        $book->Subjects()->sync($data['subject_id'] ?? []);

        return $book;
    }

    public function delete(int $id)
    {
        $author = Books::find($id);

        return $author->delete();
    }
}
