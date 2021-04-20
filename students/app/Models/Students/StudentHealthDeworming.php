<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHealthDeworming extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_deworming";

    protected $fillable = [
        'id',
        'StdHealthTermId',
        'date',
        'StdStudentId',
        'status',
    ];
}
