<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaScoutSection extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scout_section";

    protected $fillable = [
        'id',
        'name',
        'description', 
        'status'
    ];
}
