<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory, Uuid;
    protected $table = "aca_teacher_subject";
    protected $fillable = [
        'id',
        'name',
        'code',
        'is_special_educational_needs',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
