<?php

namespace App\Models\staff_services;

use App\Models\staff_masters\LeaveType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class LeaveApplication extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_leave_application";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'application_number',
        'leave_type_id',
        'staff_id',
        'year',
        'date_of_application',
        'reason',
        'from_date',
        'to_date',
        'no_days',
        'remarks',
        'org_id',
        'dzongkhag_id',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'

    ];
    public function leaveDetails(){
        return $this->belongsTo(LeaveType::class, 'leave_type_id')->select('id','no_days','name','category');
    }
}
