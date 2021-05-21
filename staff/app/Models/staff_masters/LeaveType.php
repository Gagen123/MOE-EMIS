<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class LeaveType extends Model
{
    use HasFactory, Uuid;
    protected $table="master_staff_leave_type";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'no_days',
        'code',
        'category',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
