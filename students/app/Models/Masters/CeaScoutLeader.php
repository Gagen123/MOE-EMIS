<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaScoutLeader extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scout_leaders";

    protected $fillable = [
        'id',
        'Name',
        'description', 
        'status'
    ];
}
