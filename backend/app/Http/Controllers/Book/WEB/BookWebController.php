<?php

namespace App\Http\Controllers\Book\WEB;

use App\Http\Controllers\Controller;
use App\Application\Book\RegisterBook;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookWebController extends Controller
{
    public function __construct(
        private readonly RegisterBook $registerBook
    ) {}

    public function index(): View
    {
        $books = $this->registerBook->findAll();
        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function show(string $id): View
    {
        $book = $this->registerBook->findById($id);
        return view('books.show', compact('book'));
    }

    public function edit(string $id): View
    {
        $book = $this->registerBook->findById($id);
        return view('books.edit', compact('book'));
    }

    public function viewArchive(): View
    {
        return view('books.archive');
    }

    public function store(Request $request)
    {
        // Log the incoming request data
        \Log::info('Store Book Request Data:', $request->all());

        $validated = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string',
            'drawer' => 'required|string',
            'author' => 'required|string',
        ]);

        try {
            $this->registerBook->create(
                $validated['category'],
                $validated['name'],
                $validated['drawer'],
                $validated['author']
            );
            return redirect()->route('book.index')->with('success', 'Book added successfully');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error('Error adding book: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error adding book: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        \Log::info('Attempting to delete book with ID: ' . $id);

        try {
            $this->registerBook->deleteBook($id);
            return redirect()->route('book.index')->with('success', 'Book deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error deleting book: ' . $e->getMessage());
            return back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string',
            'drawer' => 'required|string',
            'author' => 'required|string',
        ]);

        try {
            $this->registerBook->updateBook($id, $validated);
            return redirect()->route('book.index')->with('success', 'Book updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating book: ' . $e->getMessage());
        }
    }
}
