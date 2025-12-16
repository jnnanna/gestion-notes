<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'module_id',
        'exam_grade',
        'cc_grade',
        'final_grade',
        'status',
        'validated_by_user_id',
        'validated_at',
        'comments'
    ];

    protected $casts = [
        'exam_grade' => 'decimal:2',
        'cc_grade' => 'decimal:2',
        'final_grade' => 'decimal:2',
        'validated_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function validatedBy()
    {
        return $this->belongsTo(User::class, 'validated_by_user_id');
    }
}
