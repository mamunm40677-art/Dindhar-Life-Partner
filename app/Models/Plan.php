<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'subtitle',
        'badge',
        'price',
        'period',
        'connection_limit',
        'features',
        'is_popular',
        'is_active',
        'sort_order',
        'button_text',
        'button_link',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'connection_limit' => 'integer',
            'features' => 'array',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
