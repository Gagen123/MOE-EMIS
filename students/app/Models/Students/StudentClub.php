<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentClub extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="student_club";

    protected $fillable = [
        'organizationId',
        'id',
        'StdStudentId', 
        'status',
        'CeaSchoolProgrammeId',
        'Responsibility',
        'JoiningDate',
        'role',
       
    ];
}
