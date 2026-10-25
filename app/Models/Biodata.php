<?php

namespace App\Models;

use Database\Factories\BiodataFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Biodata extends Model
{
    /** @use HasFactory<BiodataFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'display_name',
        'gender',
        'age',
        'marital_status',
        'city',
        'education',
        'occupation',
        'about',
        'deendar_practice',
        'published',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'age' => 'integer',
            'published' => 'boolean',
        ];
    }
}
