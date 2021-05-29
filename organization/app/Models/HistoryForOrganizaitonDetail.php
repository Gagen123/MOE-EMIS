<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryForOrganizaitonDetail extends Model{
    
    use HasFactory;
    protected $table="organization_details_history";
    protected $fillable = [
        'record_id',
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
        'updated_by',
        'remarks',
        'recorded_on',
        'recorded_for'
    ];
}
