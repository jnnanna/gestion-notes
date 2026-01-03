<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'annee_academique_id',
        'feuille_note_id',
        'type',
        'nom',
        'chemin',
        'metadata',
        'archive_par',
    ];

    protected $casts = [
        'metadata' => 'json',
    ];

    // Relations
    public function anneeAcademique(): BelongsTo
    {
        return $this->belongsTo(AnneeAcademique:: class);
    }

    public function feuilleNote(): BelongsTo
    {
        return $this->belongsTo(FeuilleNote::class);
    }

    public function archivePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archive_par');
    }

    // Scopes
    public function scopeParAnnee($query, int $anneeAcademiqueId)
    {
        return $query->where('annee_academique_id', $anneeAcademiqueId);
    }

    public function scopeParType($query, string $type)
    {
        return $query->where('type', $type);
    }

    // Accessors
    public function getUrlAttribute(): string
    {
        return Storage::url($this->chemin);
    }

    public function getTailleAttribute(): int
    {
        if (!Storage::exists($this->chemin)) {
            return 0;
        }

        return Storage::size($this->chemin);
    }

    public function getTailleHumaineAttribute(): string
    {
        $bytes = $this->taille;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Methods
    public function supprimer(): bool
    {
        if (Storage::exists($this->chemin)) {
            Storage::delete($this->chemin);
        }

        return $this->delete();
    }
}