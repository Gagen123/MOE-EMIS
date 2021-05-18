<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramActionPlan extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_action_plan";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'CeaProgrammeId',
        'FromDate',
        'ToDate'
    ];
}