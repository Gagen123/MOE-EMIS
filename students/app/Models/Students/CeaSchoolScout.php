<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaSchoolScout extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_school_scouts";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'CeaScoutsId',
        'EstablishmentYear',
        'Remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

}
