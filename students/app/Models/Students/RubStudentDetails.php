<?php

namespace App\Models\Students;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RubStudentDetails extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="rub_student_details";
    protected $fillable = [
        'id',
        'studentName',
        'institute_id',
        'studentEmail',
        'student_contactNo',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at'
    ];
}
