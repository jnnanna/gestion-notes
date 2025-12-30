<?php

namespace App\Models;

use App\Enums\StatutNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'etudiant_id',
        'module_id',
        'feuille_note_id',
        'note_examen',
        'note_cc',
        'note_tp',
        'moyenne',
        'statut',
        'commentaire',
    ];

    protected $casts = [
        'note_examen' => 'decimal: 2',
        'note_cc' => 'decimal:2',
        'note_tp' => 'decimal:2',
        'moyenne' => 'decimal:2',
        'statut' => StatutNote::class,
    ];

    // Relations
    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function feuilleNote(): BelongsTo
    {
        return $this->belongsTo(FeuilleNote::class);
    }

    public function historiqueValidations(): HasMany
    {
        return $this->hasMany(HistoriqueValidation::class);
    }

    // Scopes
    public function scopeParEtudiant($query, int $etudiantId)
    {
        return $query->where('etudiant_id', $etudiantId);
    }

    public function scopeParModule($query, int $moduleId)
    {
        return $query->where('module_id', $moduleId);
    }

    public function scopeValidees($query)
    {
        return $query->where('statut', StatutNote:: VALIDE);
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', StatutNote::EN_ATTENTE);
    }

    // Methods
    public function calculerMoyenne(): void
    {
        $notes = collect([
            $this->note_examen,
            $this->note_cc,
            $this->note_tp,
        ])->filter()->values();

        if ($notes->isEmpty()) {
            $this->moyenne = null;
            return;
        }

        // Calcul simple :  moyenne arithmétique
        // TODO:   Adapter selon les coefficients du module
        $this->moyenne = round($notes->avg(), 2);
        $this->save();
    }

    public function valider(): void
    {
        $this->update(['statut' => StatutNote:: VALIDE]);
    }

    public function rejeter(): void
    {
        $this->update(['statut' => StatutNote::REJETE]);
    }

    public function estAdmis(): bool
    {
        return $this->moyenne >= 10;
    }

    public function getMentionAttribute(): string
    {
        if (! $this->moyenne) {
            return 'Non évalué';
        }

        return match(true) {
            $this->moyenne >= 16 => 'Très Bien',
            $this->moyenne >= 14 => 'Bien',
            $this->moyenne >= 12 => 'Assez Bien',
            $this->moyenne >= 10 => 'Passable',
            default => 'Insuffisant',
        };
    }

    // Events
    protected static function booted(): void
    {
        static:: saving(function (Note $note) {
            // Recalculer la moyenne automatiquement
            if ($note->isDirty(['note_examen', 'note_cc', 'note_tp'])) {
                $notes = collect([
                    $note->note_examen,
                    $note->note_cc,
                    $note->note_tp,
                ])->filter()->values();

                $note->moyenne = $notes->isEmpty() ? null : round($notes->avg(), 2);
            }
        });
    }
}