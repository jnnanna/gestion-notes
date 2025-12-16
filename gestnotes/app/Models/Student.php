<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'matricule',
        'first_name',
        'last_name',
        'email',
        'filiere_id',
        'promotion_year',
        'group'
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
