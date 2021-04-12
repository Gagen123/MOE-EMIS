<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHealthBmi extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_screening";

    protected $fillable = [
        'id',
        'StdHealthScreeningId', 
    ];
}
