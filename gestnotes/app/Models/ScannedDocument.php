<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScannedDocument extends Model
{
    protected $fillable = [
        'file_path',
        'file_type',
        'file_size',
        'module_id',
        'exam_date',
        'uploaded_by_user_id',
        'ocr_status'
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by_user_id');
    }
}
