<?php

namespace App\Application\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepository;

class RegisterBook
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function create(
        string $Category,
        string $Bookname,
        string $Drawer,
        string $Author,
    ): void {
        $data = new Book(
            null,
            $Category,
            $Bookname,
            $Drawer,
            $Author,
        );
        // dd($data);
        $this->bookRepository->create($data);
    }

    public function update(
        string $id,
        string $Category,
        string $Bookname,
        string $Drawer,
        string $Author
    ): ?Book {
        $bookModel = $this->bookRepository->findById($id);
        if (! $bookModel) {
            throw new \Exception('Book not found.');
        }

        $data = new Book(
            $id,
            $Category,
            $Bookname,
            $Drawer,
            $Author
        );

        $this->bookRepository->update($data);

        return $data;
    }

    public function findByID(string $id)
    {
        return $this->bookRepository->findByID($id);
    }

    public function findAll(): array
    {
        return $this->bookRepository->findAll();
    }

    public function delete(string $id)
    {
        return $this->bookRepository->delete($id);
    }

    public function getBook(string $id): ?Book
    {
        return $this->bookRepository->findById($id);
    }

    public function getFindAllBook(): array
    {
        return $this->bookRepository->findAll();
    }
}
