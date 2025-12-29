<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'nom',
        'description',
        'chef_id',
        'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    // Relations
    public function chef(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function filieres(): HasMany
    {
        return $this->hasMany(Filiere::class);
    }

    public function enseignants(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function modules(): HasManyThrough
    {
        return $this->hasManyThrough(Module::class, Filiere::class);
    }

    public function etudiants(): HasManyThrough
    {
        return $this->hasManyThrough(Etudiant::class, Filiere::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    // Accessors
    public function getNombreFilieresAttribute(): int
    {
        return $this->filieres()->count();
    }

    public function getNombreEnseignantsAttribute(): int
    {
        return $this->enseignants()->count();
    }

    public function getNombreEtudiantsAttribute(): int
    {
        return $this->etudiants()->count();
    }
}