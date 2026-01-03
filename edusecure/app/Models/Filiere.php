<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filiere extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'nom',
        'description',
        'niveau',
        'departement_id',
        'chef_id',
        'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    // Relations
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement:: class);
    }

    public function chef(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }

    public function importations(): HasMany
    {
        return $this->hasMany(Importation::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    public function scopeParNiveau($query, string $niveau)
    {
        return $query->where('niveau', $niveau);
    }

    // Accessors
    public function getNombreModulesAttribute(): int
    {
        return $this->modules()->count();
    }

    public function getNombreEtudiantsAttribute(): int
    {
        return $this->etudiants()->count();
    }
}