<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthScreening extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_screening_type";

    protected $fillable = [
        'id',
        'name', 
        'description',
        'Status'
    ];
}
