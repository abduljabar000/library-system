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
        try {
            $book = $this->registerBook->create(
                $request->Category,
                $request->Book,
                $request->Drawer,
                $request->Author,
            );

            return response()->json([
                'message' => 'Book created successfully',
                'data' => $book,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getBook(Request $request)
    {
        try {
            $book = $this->registerBook->getBook($request->id);

            return response()->json(['data' => $book]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateBook(Request $request)
    {
        try {
            $book = $this->registerBook->update(
                $request->id,
                $request->Category,
                $request->Bookname,
                $request->Drawer,
                $request->Author
            );

            return response()->json([
                'message' => 'Book updated successfully',
                'data' => $book,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteBook(Request $request)
    {
        try {
            $this->registerBook->deleteBook($request->id);

            return response()->json([
                'message' => 'Book deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getFindAllBook(Request $request)
    {
        try {
            $books = $this->registerBook->getFindAllBook();

            return response()->json(['data' => $books]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching books',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
