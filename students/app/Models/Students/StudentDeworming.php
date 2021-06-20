<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentDeworming extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_deworming";

    protected $fillable = [
        'id',
        'StdHealthDewormingId',
        'StdStudentId',
        'status',
    ];
}
