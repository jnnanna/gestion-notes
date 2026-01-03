<?php

namespace App\Models;

use App\Enums\StatutFeuilleNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeuilleNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'feuilles_notes';

    protected $fillable = [
        'code',
        'module_id',
        'importation_id',
        'fichier_importe_id',
        'enseignant_id',
        'annee_academique_id',
        'statut',
        'date_examen',
        'type_evaluation',
        'remarques',
        'soumis_at',
        'valide_at',
        'validateur_id',
        'verrouille_at',
    ];

    protected $casts = [
        'statut' => StatutFeuilleNote::class,
        'date_examen' => 'date',
        'soumis_at' => 'datetime',
        'valide_at' => 'datetime',
        'verrouille_at' => 'datetime',
    ];

    // Relations
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function importation(): BelongsTo
    {
        return $this->belongsTo(Importation::class);
    }

    public function fichierImporte(): BelongsTo
    {
        return $this->belongsTo(FichierImporte::class);
    }

    public function enseignant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }

    public function anneeAcademique(): BelongsTo
    {
        return $this->belongsTo(AnneeAcademique::class);
    }

    public function validateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validateur_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function historiqueValidations(): HasMany
    {
        return $this->hasMany(HistoriqueValidation::class);
    }

    // Scopes
    public function scopeParStatut($query, StatutFeuilleNote $statut)
    {
        return $query->where('statut', $statut);
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', StatutFeuilleNote::SOUMIS);
    }

    public function scopeValidees($query)
    {
        return $query->where('statut', StatutFeuilleNote:: VALIDE);
    }

    // Methods
    public function soumettre(): void
    {
        $this->update([
            'statut' => StatutFeuilleNote:: SOUMIS,
            'soumis_at' => now(),
        ]);
    }

    public function valider(User $validateur): void
    {
        $this->update([
            'statut' => StatutFeuilleNote::VALIDE,
            'valide_at' => now(),
            'validateur_id' => $validateur->id,
        ]);
    }

    public function verrouiller(): void
    {
        $this->update([
            'statut' => StatutFeuilleNote::VERROUILLE,
            'verrouille_at' => now(),
        ]);
    }

    public function rejeter(): void
    {
        $this->update([
            'statut' => StatutFeuilleNote::REJETE,
        ]);
    }

    public function estModifiable(): bool
    {
        return in_array($this->statut, [
            StatutFeuilleNote::BROUILLON,
            StatutFeuilleNote::SOUMIS,
        ]);
    }
}