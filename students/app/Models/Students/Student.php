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
        'IsRejoined',
        'PhotoPath',
        'PrimaryContact',
        'CmnParentsMaritalStatusId'
    ];

    public function CeaStudentAwards(){
        return $this->hasMany(CeaStudentAward::class,'id','StdStudentId');
    }
}
