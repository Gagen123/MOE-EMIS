<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHistory extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_history";

    protected $fillable = [
        'id',
        'StdStudentId',
        'historyFor',
        'previousValue',
        'Remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

}
