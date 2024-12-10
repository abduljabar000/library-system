<?php

namespace App\Domain\Book;

interface BookRepository
{
    public function findAll();
    public function findById(string $id);
    public function create(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
}
