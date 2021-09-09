<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaSchoolProgramme extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_school_programme";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'CeaProgrammeId',
        'CeaProgrammeTypeId',
        'EstablishmentYear',
        'CeaProgrammeSupporterId',
        'Remarks'
    ];
}
