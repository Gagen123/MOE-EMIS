<?php

namespace App\Models\staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;


class StaffManagementMeetingMember extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_management_meeting_members";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'meeting_id',
        'member_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
