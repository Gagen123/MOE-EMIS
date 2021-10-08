<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplementaryStudent extends Model
{
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="std_student_supplementary";
    protected $fillable = [
        'id ',
        'StdStudentId ',
        'retakeCA',
        'AcademicYear',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
