<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentScreened extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_not_screened";

    protected $fillable = [
        'id',
        'StdHealthScreeningId', 
        'StdStudentId'
    ];
}
