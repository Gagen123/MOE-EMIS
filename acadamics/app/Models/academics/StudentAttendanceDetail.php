<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAttendanceDetail extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_student_attendance_detail";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aca_std_attendance_id',
        'std_student_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
