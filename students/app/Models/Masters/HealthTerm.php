<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthTerm extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_term";

    protected $fillable = [
        'id',
        'Name', 
        'Status'
    ];
}
