<?php

namespace App\Http\Controllers\Dashboard\Web;

use App\Http\Controllers\Controller;
use App\Application\Book\RegisterBook;
use App\Application\Worker\RegisterWorker;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class DashboardWebController extends Controller
{
    public function __construct(
        private readonly RegisterBook $registerBook,
        private readonly RegisterWorker $registerWorker
    ) {}

    public function index(): View
    {
        try {
            $books = $this->registerBook->findAll();
            $workers = $this->registerWorker->findAll();

            $stats = [
                'counts' => [
                    'books' => $books->count(),
                    'workers' => [
                        'active' => $workers->filter(fn($worker) => $worker->isActive())->count()
                    ]
                ]
            ];

            return view('pages.home.dashboard', ['stats' => $stats]);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return view('pages.home.dashboard', [
                'stats' => [
                    'counts' => [
                        'books' => 0,
                        'workers' => ['active' => 0]
                    ]
                ]
            ])->with('error', 'Error loading dashboard data');
        }
    }
}
