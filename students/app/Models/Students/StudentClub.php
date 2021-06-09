<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;

class StudentClub extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="student_club";

    protected $fillable = [
        'id',
        'StdStudentId', 
        'status',
        'CeaSchoolProgrammeId',
        'Responsibility',
        'JoiningDate',
        'role',
       
    ];
}
