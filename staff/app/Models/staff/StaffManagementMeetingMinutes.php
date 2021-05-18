<?php

namespace App\Models\staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class StaffManagementMeetingMinutes extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_management_meeting_minutes";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'meeting_id',
        'minutes',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
