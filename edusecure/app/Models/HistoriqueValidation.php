<?php

namespace App\Models;

use App\Enums\TypeAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'feuille_note_id',
        'note_id',
        'user_id',
        'action',
        'description',
        'valeur_avant',
        'valeur_apres',
        'ip_address',
    ];

    protected $casts = [
        'action' => TypeAction::class,
        'valeur_avant' => 'json',
        'valeur_apres' => 'json',
    ];

    // Relations
    public function feuilleNote(): BelongsTo
    {
        return $this->belongsTo(FeuilleNote::class);
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeParFeuilleNote($query, int $feuilleNoteId)
    {
        return $query->where('feuille_note_id', $feuilleNoteId);
    }

    public function scopeParNote($query, int $noteId)
    {
        return $query->where('note_id', $noteId);
    }

    public function scopeParAction($query, TypeAction $action)
    {
        return $query->where('action', $action);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Methods
    public static function enregistrer(
        ? FeuilleNote $feuilleNote,
        ?Note $note,
        User $user,
        TypeAction $action,
        string $description,
        ? array $valeurAvant = null,
        ?array $valeurApres = null
    ): self {
        return self::create([
            'feuille_note_id' => $feuilleNote?->id,
            'note_id' => $note?->id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
            'valeur_avant' => $valeurAvant,
            'valeur_apres' => $valeurApres,
            'ip_address' => request()->ip(),
        ]);
    }

    // Accessors
    public function getChangementsAttribute(): array
    {
        if (!$this->valeur_avant || !$this->valeur_apres) {
            return [];
        }

        $changements = [];
        
        foreach ($this->valeur_apres as $cle => $nouvelleValeur) {
            $ancienneValeur = $this->valeur_avant[$cle] ?? null;
            
            if ($ancienneValeur !== $nouvelleValeur) {
                $changements[$cle] = [
                    'avant' => $ancienneValeur,
                    'apres' => $nouvelleValeur,
                ];
            }
        }

        return $changements;
    }
}