<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPlanHistory extends Model
{
    use HasFactory, Uuid;
    
    protected $table="spm_school_plan_history";
    protected $fillable = [
        'id',
        'user_id',
        'spm_school_plan_id',
        'name',
        'role',
        'organization',
        'implementation_status_id',
        'status_date',
        'remarks',
    ];
}
