<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nom',
        'ordre',
    ];

    protected $casts = [
        'ordre' => 'integer',
    ];

    // Relations
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function importations(): HasMany
    {
        return $this->hasMany(Importation::class);
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre');
    }
}