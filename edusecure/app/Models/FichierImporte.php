<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class FichierImporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'importation_id',
        'nom_original',
        'nom_stockage',
        'chemin',
        'type_mime',
        'taille',
        'ocr_traite',
        'ocr_resultat',
        'ocr_confiance',
    ];

    protected $casts = [
        'taille' => 'integer',
        'ocr_traite' => 'boolean',
        'ocr_confiance' => 'decimal:2',
    ];

    // Relations
    public function importation(): BelongsTo
    {
        return $this->belongsTo(Importation::class);
    }

    // Accessors
    public function getUrlAttribute(): string
    {
        return Storage::url($this->chemin);
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