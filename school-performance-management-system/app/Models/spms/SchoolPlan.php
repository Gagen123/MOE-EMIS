<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPlan extends Model
{
    use HasFactory, Uuid;
    
    protected $table="spm_school_plan";
    protected $fillable = [
        'id',
        'org_id',
        'spm_domain_id',
        'year',
        'activity',
        'objective',
        'strategy',
        'start_date',
        'end_date',
        'person_responsible',
        'implementation_status_id',
        'school_plan_status',
        'remarks',
        'created_by'
    ];
}
