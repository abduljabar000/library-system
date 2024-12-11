<?php

namespace App\Application\Book;

use App\Domain\Book\BookRepository;

class RegisterBook
{
    public function __construct(
        private readonly BookRepository $bookRepository
    ) {}

    public function findAll()
    {
        return $this->bookRepository->findAll();
    }

    public function findById(string $id)
    {
        return $this->bookRepository->findById($id);
    }

    public function create(string $category, string $name, string $drawer, string $author)
    {
        return $this->bookRepository->create([
            'category' => $category,
            'name' => $name,
            'drawer' => $drawer,
            'author' => $author
        ]);
    }

    public function updateBook(string $id, array $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    public function deleteBook(string $id)
    {
        return $this->bookRepository->delete($id);
    }
}
