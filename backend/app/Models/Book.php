<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';
    
    protected $fillable = [
        'category',
        'name',
        'drawer',
        'author'
    ];

    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDrawer()
    {
        return $this->drawer;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'category' => $this->getCategory(),
            'name' => $this->getName(),
            'drawer' => $this->getDrawer(),
            'author' => $this->getAuthor()
        ];
    }
}
