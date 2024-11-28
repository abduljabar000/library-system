<?php

namespace App\Infrastructure\Persistence\Eloquent\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepository;

class EloquentBookRepository implements BookRepository
{
    public function findAll(): array
    {
        return BookModel::all()->map(
            fn ($bookModel) => new Book(
                $bookModel->id,
                $bookModel->Category,
                $bookModel->Bookname,
                $bookModel->Drawer,
                $bookModel->Author,
            )
        )->toArray();
    }

    public function create(Book $book): void
    {
        // BookModel::create($book);
        dd($book);
    }

    public function findById(string $id): Book
    {
        return BookModel::find($id);
    }

    public function update(Book $book): void
    {
        BookModel::find($id)->update($data);
    }

    public function delete(string $id): void
    {
        BookModel::find($id)->delete();
    }
}
