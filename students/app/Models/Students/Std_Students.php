<?php

namespace App\Models\students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Std_Students extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
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
        'CmnParentsMaritalStatusId',
        'Address',
        'Status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
