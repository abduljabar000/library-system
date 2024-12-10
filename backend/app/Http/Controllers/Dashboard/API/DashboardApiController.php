<?php

namespace App\Http\Controllers\Dashboard\API;

use App\Http\Controllers\Controller;
use App\Application\Book\RegisterBook;
use App\Application\Worker\RegisterWorker;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DashboardApiController extends Controller
{
    public function __construct(
        private readonly RegisterBook $registerBook,
        private readonly RegisterWorker $registerWorker
    ) {}

    public function getAll(): JsonResponse
    {
        try {
            $books = $this->registerBook->findAll();
            $workers = $this->registerWorker->findAll();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'books' => array_map(fn($book) => $book->toArray(), $books),
                    'workers' => array_map(fn($worker) => $worker->toArray(), $workers)
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching all data: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage());
        }
    }

    public function search(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'search' => 'nullable|string|max:255',
                'type' => 'nullable|string|in:all,books,workers'
            ]);

            $searchTerm = $validated['search'] ?? '';
            $type = $validated['type'] ?? 'all';

            $results = [
                'books' => [],
                'workers' => []
            ];

            if ($type === 'all' || $type === 'books') {
                $bookResults = $this->registerBook->search($searchTerm);
                $results['books'] = [
                    'match' => $bookResults['match'] ? $bookResults['match']->toArray() : null,
                    'related' => array_map(fn($book) => $book->toArray(), $bookResults['related'] ?? [])
                ];
            }

            if ($type === 'all' || $type === 'workers') {
                $workerResults = $this->registerWorker->search($searchTerm);
                $results['workers'] = [
                    'match' => $workerResults['match'] ? $workerResults['match']->toArray() : null,
                    'related' => array_map(fn($worker) => $worker->toArray(), $workerResults['related'] ?? [])
                ];
            }

            return response()->json([
                'status' => 'success',
                'data' => $results
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error searching data: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage());
        }
    }

    public function getDashboardStats(): JsonResponse
    {
        try {
            $books = $this->registerBook->findAll();
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'counts' => [
                        'total' => count($books)
                    ],
                    'categoryStats' => $this->registerBook->getCategoryStats(),
                    'authorStats' => $this->registerBook->getAuthorStats()
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Error loading dashboard data'
            ], 500);
        }
    }

    private function getWorkerPositionStats(array $workers): array
    {
        $positions = [];
        foreach ($workers as $worker) {
            $position = $worker->getPosition();
            $positions[$position] = ($positions[$position] ?? 0) + 1;
        }
        return $positions;
    }

    private function errorResponse(string $message): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 500);
    }
}