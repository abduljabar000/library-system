<?php

namespace App\Domain\Book;

use App\Models\Book;

class BookRepository
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
        return Book::create($data);
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
