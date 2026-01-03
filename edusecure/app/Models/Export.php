<?php

namespace App\Models;

use App\Enums\TypeDocument;
use App\Enums\TypeExport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Export extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_document',
        'format',
        'nom_fichier',
        'chemin',
        'parametres',
        'taille',
        'nb_telechargements',
        'expire_at',
    ];

    protected $casts = [
        'type_document' => TypeDocument::class,
        'format' => TypeExport::class,
        'parametres' => 'json',
        'taille' => 'integer',
        'nb_telechargements' => 'integer',
        'expire_at' => 'datetime',
    ];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeNonExpires($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expire_at')
              ->orWhere('expire_at', '>', now());
        });
    }

    public function scopeExpires($query)
    {
        return $query->whereNotNull('expire_at')
            ->where('expire_at', '<=', now());
    }

    public function scopeParFormat($query, TypeExport $format)
    {
        return $query->where('format', $format);
    }

    public function scopeParTypeDocument($query, TypeDocument $type)
    {
        return $query->where('type_document', $type);
    }

    // Accessors
    public function getUrlTelechargementAttribute(): string
    {
        return route('exportation.telecharger', $this);
    }

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

    public function getEstExpireAttribute(): bool
    {
        return $this->expire_at && $this->expire_at->isPast();
    }

    // Methods
    public function incrementerTelechargements(): void
    {
        $this->increment('nb_telechargements');
    }

    public function supprimer(): bool
    {
        if (Storage::exists($this->chemin)) {
            Storage::delete($this->chemin);
        }

        return $this->delete();
    }

    public static function nettoyerExpires(): int
    {
        $exports = self::expires()->get();
        
        $count = 0;
        foreach ($exports as $export) {
            if ($export->supprimer()) {
                $count++;
            }
        }

        return $count;
    }
}