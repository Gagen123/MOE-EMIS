<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'CidNo',
        'student_code',
        'Name',
        'CmnSexId',
        'DateOfBirth',
        'CmnCountryId',
        'CmnGewogId',
        'CmnChiwogId',
        'CmnLanguageId',
        'Remarks',
        'IsNewAdmission',
        'IsTransferred',
        'isSenStudent',
        'IsRejoined',
        'PhotoPath',
        'PrimaryContact',
        'CmnParentsMaritalStatusId',
        'Remarks',
        'Address',
        'Status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function CeaStudentAwards(){
        return $this->hasMany(CeaStudentAward::class,'id','StdStudentId');
    }
}
