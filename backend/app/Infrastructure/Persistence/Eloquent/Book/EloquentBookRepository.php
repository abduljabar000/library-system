<?php

namespace App\Infrastructure\Persistence\Eloquent\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepository;

class EloquentBookRepository implements BookRepository
{
    public function findAll(): array
    {
        $books = BookModel::all();

        return $books->map(function ($bookModel) {
            $book = new Book(
                $bookModel->id,
                $bookModel->Category,
                $bookModel->Bookname,
                $bookModel->Drawer,
                $bookModel->Author
            );

            return $book->toArray();
        })->toArray();
    }

    public function create(Book $book): void
    {
        BookModel::create([
            'Category' => $book->getCategory(),
            'Bookname' => $book->getBookname(),
            'Drawer' => $book->getDrawer(),
            'Author' => $book->getAuthor(),
        ]);
    }

    public function findById(string $id): ?Book
    {
        $bookModel = BookModel::find($id);

        if (! $bookModel) {
            return null;
        }

        return new Book(
            $bookModel->id,
            $bookModel->Category,
            $bookModel->Bookname,
            $bookModel->Drawer,
            $bookModel->Author
        );
    }

    public function update(Book $book): void
    {
        $bookModel = BookModel::find($book->getID());
        if ($bookModel) {
            $bookModel->update([
                'Category' => $book->getCategory(),
                'Bookname' => $book->getBookname(),
                'Drawer' => $book->getDrawer(),
                'Author' => $book->getAuthor(),
            ]);
        }
    }

    public function delete(string $id): void
    {
        BookModel::find($id)->delete();
    }
}
