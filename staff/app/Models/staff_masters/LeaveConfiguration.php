<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class LeaveConfiguration extends Model
{
    use HasFactory, Uuid;
    protected $table="master_staff_leave_config";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'leave_type_id',
        'submitter_role_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function leaveDetails(){
        return $this->belongsTo(LeaveType::class, 'leave_type_id')->select('id','no_days','name','category');
    }
}
