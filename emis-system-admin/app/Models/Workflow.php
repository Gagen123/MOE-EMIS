<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Workflow extends Model{
    use HasFactory, Uuid;
    protected $table="workflow_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'database_name',
        'table_name',
        'service_name',
        'application_number',
        'screen_id',
        'status_id',
        'w_config_status',
        'remarks',
        'action_by',
        'action_date',
    ];
}
