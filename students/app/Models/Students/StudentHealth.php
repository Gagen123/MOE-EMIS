<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHealth extends Model
{
    use HasFactory, Uuid;
    //use for other student health related
    //protected $table="std_health_screening";

    protected $fillable = [
        'id',
        'StdHealthScreeningId', 
        'StdScreeningPositionTitleId',
        'StdScreeningEndorsedById',
        'date',
        'boys_screened',
        'girls_screened',
        'boys_referred',
        'girls_referred'
    ];
}
