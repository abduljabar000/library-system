<?php

namespace App\Http\Controllers\Book\API;

use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookApiController extends Controller
{
    public function __construct(
        private readonly RegisterBook $registerBook
    ) {}

    public function index(): JsonResponse
    {
        try {
            $books = $this->registerBook->findAll();
            return response()->json([
                'status' => 'success',
                'data' => array_map(fn($book) => $book->toArray(), $books)
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'category' => 'required|string',
                'name' => 'required|string',
                'drawer' => 'required|string',
                'author' => 'required|string',
            ]);

            $book = $this->registerBook->create(
                $validated['category'],
                $validated['name'],
                $validated['drawer'],
                $validated['author']
            );

            return response()->json([
                'status' => 'success',
                'data' => $book->toArray()
            ], 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $book = $this->registerBook->findById($id);
            return response()->json([
                'status' => 'success',
                'data' => $book->toArray()
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'category' => 'string',
                'name' => 'string',
                'drawer' => 'string',
                'author' => 'string',
            ]);

            $book = $this->registerBook->updateBook($id, $validated);
            return response()->json([
                'status' => 'success',
                'data' => $book->toArray()
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->registerBook->deleteBook($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Book deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    private function errorResponse(string $message): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 500);
    }
}
