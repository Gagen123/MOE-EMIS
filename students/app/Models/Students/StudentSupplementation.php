<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentSupplementation extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_supplementation";

    protected $fillable = [
        'id',
        'StdHealthSupplementationId',
        'StdStudentId',
        'status',
    ];
}
