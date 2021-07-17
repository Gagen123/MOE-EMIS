<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentBmi extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="std_student_bmi";
    protected $fillable = [
        'id',
        'StdHealthBmiId',
        'StdStudentId',
        'height',
        'weight',
        'bmi',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
