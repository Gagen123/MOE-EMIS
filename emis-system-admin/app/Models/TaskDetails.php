<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class TaskDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="task_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'table_name',
        'service_name',
        'name',
        'screen_id',
        'application_number',
        'status_id',
        'remarks',
        'access_level',
        'user_dzo_id',
        'working_agency_id',
        'created_by',
        'applied_on',
        'claimed_by',
        'w_config_status',
        'claimed_date',
        'last_action_by',
        'last_action_date',
        'app_role_id',
        'record_type_id'
    ];
}
