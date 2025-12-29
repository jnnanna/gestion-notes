<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etudiant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'date_naissance',
        'lieu_naissance',
        'filiere_id',
        'niveau',
        'groupe',
        'photo_url',
        'actif',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'actif' => 'boolean',
    ];

    // Relations
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    public function scopeParFiliere($query, int $filiereId)
    {
        return $query->where('filiere_id', $filiereId);
    }

    public function scopeParNiveau($query, string $niveau)
    {
        return $query->where('niveau', $niveau);
    }

    public function scopeParGroupe($query, string $groupe)
    {
        return $query->where('groupe', $groupe);
    }

    // Accessors
    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function getPhotoUrlAttribute($value): string
    {
        return $value ??  'https://ui-avatars.com/api/?name=' .  urlencode($this->nom_complet) . '&background=135bec&color=fff';
    }

    // Methods
    public function getMoyenneGenerale(): ?float
    {
        return $this->notes()
            ->whereNotNull('moyenne')
            ->avg('moyenne');
    }
}