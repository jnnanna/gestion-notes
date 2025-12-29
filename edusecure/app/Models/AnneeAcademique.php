<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnneeAcademique extends Model
{
    use HasFactory, SoftDeletes;

    // ✅ AJOUTER CETTE LIGNE POUR FORCER LE NOM DE LA TABLE
    protected $table = 'annees_academiques';

    protected $fillable = [
        'code',
        'libelle',
        'date_debut',
        'date_fin',
        'actif',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'actif' => 'boolean',
    ];

    // Relations
    public function importations(): HasMany
    {
        return $this->hasMany(Importation::class);
    }

    public function feuillesNotes(): HasMany
    {
        return $this->hasMany(FeuilleNote::class);
    }

    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    public function scopeCourante($query)
    {
        return $query->where('actif', true)
            ->whereDate('date_debut', '<=', now())
            ->whereDate('date_fin', '>=', now())
            ->first();
    }

    // Accessors
    public function getEstCouranteAttribute(): bool
    {
        return $this->actif 
            && $this->date_debut <= now() 
            && $this->date_fin >= now();
    }
}