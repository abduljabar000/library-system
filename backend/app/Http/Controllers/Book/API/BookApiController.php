<?php

namespace App\Http\Controllers\Book\API;

use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    private RegisterBook $registerBook;

    public function __construct(RegisterBook $registerBook)
    {
        $this->registerBook = $registerBook;
    }

    /**
     * Create Book on database
     * **/
    public function registerBook(Request $request)
    {
        // dd($request->all());
        $this->registerBook->create(
            $request->Category,
            $request->Book,
            $request->Drawer,
            $request->Author,
        );
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
