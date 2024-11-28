<?php

namespace App\Domain\Book;

/**
 * Data caps ang mga names sa folder tanan.
 * **/
class Book
{
    private ?int $id;

    private ?string $Category;

    private ?string $Bookname;

    private ?string $Drawer;

    private ?string $Author;


    public function __construct(
        ?int $id = null,
        ?string $Category = null,
        ?string $Bookname = null,
        ?string $Drawer = null,
        ?string $Author = null,
    ) {
        $this->id = $id;
        $this->Category = $Category;
        $this->Bookname = $Bookname;
        $this->Drawer = $Drawer;
        $this->Author = $Author;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'Category' => $this->Category,
            'Bookname' => $this->Bookname,
            'Drawer' => $this->Drawer,
            'Author' => $this->Author,
        ];
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->Category;
    }

    public function getBookname()
    {
        return $this->Bookname;
    }

    public function getDrawer()
    {
        return $this->Drawer;
    }

    public function getAuthor()
    {
        return $this->Author;
    }
}
