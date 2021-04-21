<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisciplinaryActionTaken extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="std_disciplinary_action_type";

    protected $fillable = [
        'id',
        'name', 
        'description', 
        'status'
    ];
}
