<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramItem extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_program_item";

    protected $fillable = [
        'id',
        'name', 
        'description', 
        'status'
    ];
}
