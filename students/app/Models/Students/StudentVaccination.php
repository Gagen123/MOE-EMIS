<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentVaccination extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_vaccination";

    protected $fillable = [
        'id',
        'StdHealthVaccinationId',
        'StdStudentId',
        'status',
    ];
}
