<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\SoftDeletes;  // ❌ RETIRER CETTE LIGNE
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;  // ✅ SANS SoftDeletes

    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'departement_id',
        'avatar_url',
        'actif',
        'two_factor_enabled',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'actif' => 'boolean',
        'two_factor_enabled' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    // Relations
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    public function departementsGeres(): HasMany
    {
        return $this->hasMany(Departement::class, 'chef_id');
    }

    public function filieresGerees(): HasMany
    {
        return $this->hasMany(Filiere::class, 'chef_id');
    }

    public function modulesGeres(): HasMany
    {
        return $this->hasMany(Module::class, 'responsable_id');
    }

    public function importations(): HasMany
    {
        return $this->hasMany(Importation::class);
    }

    public function exports(): HasMany
    {
        return $this->hasMany(Export::class);
    }

    public function validations(): HasMany
    {
        return $this->hasMany(HistoriqueValidation::class);
    }

    public function feuillesNotesValidees(): HasMany
    {
        return $this->hasMany(FeuilleNote::class, 'validateur_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    public function scopeEnseignants($query)
    {
        return $query->role('enseignant');
    }

    // Accessors
    public function getAvatarUrlAttribute($value): string
    {
        return $value ??  'https://ui-avatars.com/api/? name=' . urlencode($this->name) . '&background=135bec&color=fff';
    }
}