<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class std_admission extends Model
{
    //
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="std_admissions";
    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'CidNo',
        'std_id',
        'application_id',
        'snationality',
        'student_code',
        'CmnParentsMaritalStatusId',
        'IsNewAdmission',
        'IsTransferred',
        'IsRejoined',
        'PhotoPath',
        'first_name',
        'middle_name',
        'last_name',
        'DateOfBirth',
        'CmnSexId',
        'dzo_id',
        'village_id',
        'Address',
        'attachments',
        'parent_marital_status',
        'PrimaryContact',
        'dzongkhag',
        'school',
        'class_id',
        'stream_id',
        'student_type',
        'dateOfapply',
        'CmnCountryId',
        'CmnGewogId',
        'CmnChiwogId',
        'CmnLanguageId',
        'Status',
        // 'Remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
