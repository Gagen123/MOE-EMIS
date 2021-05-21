<?php

namespace App\Models\staff_services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class StaffAttendance extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_attendance";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'year',
        'month',
        'remarks',
        'org_id',
        'dzongkhag_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
