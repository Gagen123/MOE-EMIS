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
<<<<<<< HEAD
        'Address',
        'Status',
=======
>>>>>>> 82ad1363475d97a217b55f394329bbd3d58a4dc9
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
<<<<<<< HEAD
=======

>>>>>>> 82ad1363475d97a217b55f394329bbd3d58a4dc9
    ];

    public function CeaStudentAwards(){
        return $this->hasMany(CeaStudentAward::class,'id','StdStudentId');
    }
}
