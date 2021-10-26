<?php

namespace App\Models\staff;
use App\Models\staff_masters\LeaveType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ZestLeaveDetails extends Model{
    use HasFactory;
    protected $table="zest_leave_details";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'StaffID',
        'CID',
        'FromDate',
        'ToDate',
        'Duration',
        'LeaveTypeID',
        'Reason',
        'HRCNo',
        'HRCDate',
        'Rationale',
        'IsCSWSMember',
        'ContributionTypeID',
        'Active',
        'ApprovedBy',
        'ApprovedDate',
        'RejectedBy',
        'RejectedDate',
        'ExtensionID',
        'JoiningOrderNo',
        'JoiningDate',
        'Attachment',
        'StatusID',
        'WithDrawDate'
    ];
    public function leavetype(){
        return $this->belongsTo(LeaveType::class, 'LeaveTypeID')->select('id','name as mastertypename');
    }
}
