<?php

namespace App\Providers;

use App\Domain\Book\BookRepository;
use App\Infrastructure\Persistence\Eloquent\Book\EloquentBookRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BookRepository::class, EloquentBookRepository::class);
    }
}
