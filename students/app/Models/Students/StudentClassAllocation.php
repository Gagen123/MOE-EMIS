<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentClassAllocation extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_class_stream";

    protected $fillable = [
        'id',
        'StdStudentId',
        'OrgClassStreamId',
        'SectionDetailsId',
        'academicYear'
    ];

}
