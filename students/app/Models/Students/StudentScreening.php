<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentScreening extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_health_screening";

    protected $fillable = [
        'id',
        'StdHealthScreeningId',
        'StdStudentId',
        'screening_status',
        'referral_status',
    ];
}
