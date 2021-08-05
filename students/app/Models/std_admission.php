<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class std_admission extends Model{
    //
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="std_admissions";
    protected $fillable = [
        'id',
        'ApplicationId',
        'CidNo',
        'FirstName',
        'MiddleName',
        'LastName',
        'StudentCode',
        'CmnSexId',
        'DateOfBirth',
        'CmnCountryId',
        'CmnDzoId',
        'CmnGewogId',
        'CmnChiwogId',
        'CmnLanguageId',
        'CmnParentsMaritalStatusId',
        'PrimaryContact',
        'PhotoPath',
        'Address',
        'DateOfApply',
        'Remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
