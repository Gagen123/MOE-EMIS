<?php

namespace App\Models\staff_services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class StaffAttendanceDetails extends Model{
    use HasFactory, Uuid;
    protected $table="staff_attendance_dtls";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'att_id',
        'staff_id',
        'cid_work_permit',
        'no_present_days',
        'no_absent_days',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
