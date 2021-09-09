<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceHistory extends Model
{ 
    use HasFactory, Uuid;
    protected $table="aca_std_attendance_history";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'class_stream_section',
        'attendance_date',
        'std_student_id',
        'aca_absence_reason_id',
        'recorded_for',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
