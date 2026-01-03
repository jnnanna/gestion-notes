<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'department_id',
        'role_id',
        'avatar',
        '2fa_enabled',
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
            '2fa_enabled' => 'boolean',
        ];
    }

    // Relations
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Vérifie le(s) rôle(s). Accepts 'Admin' or 'Admin,Manager'
     */
    public function hasRole($roles): bool
    {
        if (! $this->relationLoaded('role') && $this->role === null) {
            $this->load('role');
        }
        $roleName = $this->role->name ?? null;
        if (! $roleName) return false;

        $roles = is_array($roles) ? $roles : array_map('trim', explode(',', $roles));
        return in_array($roleName, $roles, true);
    }

    /**
     * Vérifie une permission définie dans la table roles->permissions (JSON/array).
     */
    public function hasPermission(string $permission): bool
    {
        $permissions = $this->role->permissions ?? [];
        if (is_string($permissions)) {
            $decoded = json_decode($permissions, true);
            $permissions = is_array($decoded) ? $decoded : [];
        }
        return in_array($permission, $permissions, true);
    }

    // Helper pour le nom complet
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
