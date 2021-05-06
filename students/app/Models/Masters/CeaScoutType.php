<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaScoutType extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scouts_type";

    protected $fillable = [
        'id',
        'name', 
        'status'
    ];
}
