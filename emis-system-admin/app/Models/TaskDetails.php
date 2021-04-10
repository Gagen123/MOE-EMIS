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
        'screen_id',
        'application_number',
        'status_id',
        'remarks',
        'access_level',
        'user_dzo_id',
        'working_agency_id',
        'claimed_by',
        'claimed_date',
        'last_action_by',
        'last_action_date'
    ];
}
