<?php

namespace App\Providers;

use App\Application\Book\RegisterBook;
use App\Domain\Book\BookRepository;
use App\Infrastructure\Persistence\Eloquent\Book\EloquentBookRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BookRepository::class, EloquentBookRepository::class);
        $this->app->bind(RegisterBook::class, function ($app) {
            return new RegisterBook($app->make(BookRepository::class));
        });
    }

    public function boot()
    {
        //
    }
}
