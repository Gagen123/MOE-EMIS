<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRollNumber extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="student_rollnumbers";
    protected $fillable = [
        'id','std_class','std_stream','std_section','student_code','std_id', 'roll_no','studentList','organization_id','user_id'
    ];
}
