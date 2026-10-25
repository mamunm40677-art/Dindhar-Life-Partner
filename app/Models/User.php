<?php

namespace App\Models;

use Database\Factories\UserFactory;
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function biodata(): HasOne
    {
        return $this->hasOne(Biodata::class);
    }

    public function isAdmin(): bool
    {
        if ($this->email === 'admin@dindhar.com') {
            return true;
        }

        try {
            if (Schema::hasColumn('users', 'is_admin')) {
                return (bool) $this->is_admin;
            }
        } catch (\Throwable $e) {
            // Ignore DB schema error if column is not found
        }

        return false;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }
}
