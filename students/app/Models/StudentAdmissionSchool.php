<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StudentAdmissionSchool extends Model{
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="std_admissions_schools";
    protected $fillable = [
        'id',
        'StdAdmissionsId',
        'Dzongkhagid',
        'OrgOrganizationId',
        'class_id',
        'stream_id',
        'Status',
        'created_by',
        'school_decision',
        'student_decision',
        'dateOfapply',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
