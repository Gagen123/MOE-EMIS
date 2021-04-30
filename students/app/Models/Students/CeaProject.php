<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProject extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_project";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'CeaProjectTypeId',
        'name',
        'CeaProjectId',
        'CeaProgrammeId',
        'FromDate',
        'ToDate',
        'Place',
        'Description',
        'Status'
    ];
}
