<?php

namespace App\Infrastructure\Persistence\Eloquent\Book;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'table_books';

    protected $fillable = [
        'id',
        'Category',
        'Bookname',
        'Drawer',
        'Author'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeDeleted($query)
    {
        return $query->whereNotNull('deleted_at');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'Category' => $this->Category,
            'Bookname' => $this->Bookname,
            'Drawer' => $this->Drawer,
            'Author' => $this->Author,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
            'deleted_at' => $this->deleted_at?->toDateTimeString()
        ];
    }
}
