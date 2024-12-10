<?php

namespace App\Application\Worker;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Collection;

class RegisterWorker
{
    public function findAll(): Collection
    {
        return Worker::all();
    }

    public function search(string $term): array
    {
        $match = Worker::where('name', 'LIKE', $term)
            ->orWhere('email', 'LIKE', $term)
            ->first();

        $related = Worker::where('name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->limit(5)
            ->get();

        return [
            'match' => $match,
            'related' => $related
        ];
    }
}
