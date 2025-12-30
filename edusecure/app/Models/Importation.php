<?php

namespace App\Models;

use App\Enums\StatutImportation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Importation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'annee_academique_id',
        'module_id',
        'filiere_id',
        'semestre_id',
        'statut',
        'fichiers_total',
        'fichiers_traites',
        'fichiers_echoues',
        'notes',
        'completed_at',
    ];

    protected $casts = [
        'statut' => StatutImportation::class,
        'fichiers_total' => 'integer',
        'fichiers_traites' => 'integer',
        'fichiers_echoues' => 'integer',
        'completed_at' => 'datetime',
    ];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function anneeAcademique(): BelongsTo
    {
        return $this->belongsTo(AnneeAcademique::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class);
    }

    public function fichiers(): HasMany
    {
        return $this->hasMany(FichierImporte::class);
    }

    public function feuillesNotes(): HasMany
    {
        return $this->hasMany(FeuilleNote::class);
    }

    // Scopes
    public function scopeEnCours($query)
    {
        return $query->where('statut', StatutImportation::EN_COURS);
    }

    public function scopeComplete($query)
    {
        return $query->where('statut', StatutImportation:: COMPLETE);
    }

    // Methods
    public function marquerComplete(): void
    {
        $this->update([
            'statut' => StatutImportation::COMPLETE,
            'completed_at' => now(),
        ]);
    }

    public function getProgressionAttribute(): float
    {
        if ($this->fichiers_total === 0) {
            return 0;
        }

        return ($this->fichiers_traites / $this->fichiers_total) * 100;
    }
}