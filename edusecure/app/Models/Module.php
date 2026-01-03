<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'nom',
        'description',
        'filiere_id',
        'semestre_id',
        'responsable_id',
        'coefficient',
        'credit_ects',
        'actif',
    ];

    protected $casts = [
        'coefficient' => 'integer',
        'credit_ects' => 'decimal: 2',
        'actif' => 'boolean',
    ];

    // Relations
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere:: class);
    }

    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function feuillesNotes(): HasMany
    {
        return $this->hasMany(FeuilleNote::class);
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

    public function scopeParFiliere($query, int $filiereId)
    {
        return $query->where('filiere_id', $filiereId);
    }

    public function scopeParSemestre($query, int $semestreId)
    {
        return $query->where('semestre_id', $semestreId);
    }

    // Accessors
    public function getNombreNotesAttribute(): int
    {
        return $this->notes()->count();
    }
}