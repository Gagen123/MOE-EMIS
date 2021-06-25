<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHealthSupplementation extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_supplementation";

    protected $fillable = [
        'id',
        'StdHealthTermId',
        'date',
        'class',
        'section',
        'stream'
    ];
}
