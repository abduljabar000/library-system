<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'position',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'position' => $this->position,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
