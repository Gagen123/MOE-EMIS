<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StdSchoolLeaving extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_school_leaving";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'StdStudentId',
        'LeavingDate',
        'Reasons'
    ];
}
