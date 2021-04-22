<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentBmi extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_bmi";

    protected $fillable = [
        'id',
        'StdHealthTermId',
        'StdStudentId',
        'date',
        'height',
        'weight',
        'bmi',
        'remarks',
    ];
}
