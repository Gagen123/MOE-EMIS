<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_details";
    protected $fillable = [
        'id',
        'name',
        'code',
        'organizationType',
        'zestAgencyCode',
        'category',
        'levelId',
        'dzongkhagId',
        'gewogId',
        'chiwogId',
        'locationId',
        'isGeopoliticallyLocated',
        'isSenSchool',
        'parentSchoolId',
        'isColocated',
        'status',
        'yearOfEstablishment',
        'created_by',
        'isFeedingSchool',
        'remarks',
        'isAspNetSchool',
        'hasCounselingRoom',
        'hasShiftSystem',
        'hasCE',
        'mofCode',
        'org_id'  ,
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
