<?php

namespace App\Infrastructure\Persistence\Eloquent\Book;

use App\Domain\Book\BookRepository;
use App\Models\Book;

class EloquentBookRepository implements BookRepository
{
    public function findAll()
    {
        return Book::all();
    }

    public function findById(string $id)
    {
        return Book::findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create([
            'category' => $data['category'],
            'name' => $data['name'],
            'drawer' => $data['drawer'],
            'author' => $data['author']
        ]);
    }

    public function update(string $id, array $data)
    {
        $book = $this->findById($id);
        $book->update($data);
        return $book;
    }

    public function delete(string $id)
    {
        $book = $this->findById($id);
        return $book->delete();
    }
}
