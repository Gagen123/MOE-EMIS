<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramSupporter extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_supporter";

    protected $fillable = [
        'id',
        'name', 
        'description', 
        'status'
    ];
}
