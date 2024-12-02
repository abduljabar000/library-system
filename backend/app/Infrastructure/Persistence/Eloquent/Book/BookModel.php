<?php

namespace App\Infrastructure\Persistence\Eloquent\Book;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = 'table_books';

    protected $fillable = ['id', 'Category', 'Bookname', 'Drawer', 'Author'];
}
