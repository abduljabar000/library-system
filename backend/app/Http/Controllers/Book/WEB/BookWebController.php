<?php

namespace App\Http\Controllers\Book\WEB;

use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookWebController extends Controller
{
    public function __construct(private RegisterBook $registerBook)
    {
        $this->registerBook = $registerBook;
    }

    public function registerBook(Request $request)
    {
        $this->registerBook->create(
            $request->Category,
            $request->Bookname,
            $request->Drawer,
            $request->Author,
        );
        return redirect()->route('book.add');
        
    }

    public function getBook(Request $request)
    {
        $this->registerBook->getBook($request->id);
    }

    public function updateBook(Request $request)
    {
        $this->registerBook->updateBook($request->id, $request->all());
    }

    public function deleteBook(Request $request)
    {
        $this->registerBook->deleteBook($request->id);
    }

    public function getFindAllBook(Request $request)
    {
        $this->registerBook->getFindAllBook();
    }

}
