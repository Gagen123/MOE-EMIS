<?php

namespace App\Models\staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class StaffManagementMeeting extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_management_meetings";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'meeting_date',
        'start_time',
        'end_time',
        'venue',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
