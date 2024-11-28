<?php

namespace App\Domain\Book;

interface BookRepository
{
    public function findAll(): array;

    public function create(Book $book): void;

    public function update(Book $book): void;

    public function delete(string $id): void;

    public function findByID(string $id): ?Book;
}
