<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
            'status' => 'boolean',
            'role' => UserRole::class
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return  $this->isActive();
    }


    /**
     * Get attribute to determine if a user is an admin or not
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role == UserRole::ADMIN;
    }

    /**
     * Get attribute to get if user's status is true or false
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status;
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}