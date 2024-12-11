<?php

namespace App\Http\Controllers;

use App\Domain\Book\BookRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private BookRepository $bookRepository
    ) {}

    public function index(): View
    {
        return view('dashboard');
    }

    public function getStats()
    {
        $books = $this->bookRepository->findAll();
        
        $categories = array_unique(array_map(fn($book) => $book->getCategory(), $books));
        $authors = array_unique(array_map(fn($book) => $book->getAuthor(), $books));
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'counts' => [
                    'total' => count($books),
                    'categories' => count($categories),
                    'authors' => count($authors)
                ]
            ]
        ]);
    }
}
