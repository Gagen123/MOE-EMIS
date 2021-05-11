<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StdSeparatedWhereabouts extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_separated_whereabout";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'StdStudentId',
        'LeavingDate',
        'CurrentAddress',
        'CurrentEngagement'
    ];
}
