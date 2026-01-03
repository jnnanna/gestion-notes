<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'code',
        'name',
        'filiere_id',
        'semester',
        'coefficient',
        'ects',
        'responsible_user_id',
        'status'
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }

    public function scannedDocuments()
    {
        return $this->hasMany(ScannedDocument::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
