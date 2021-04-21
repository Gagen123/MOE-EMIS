<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffenceType extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="std_disciplinary_offence_type";

    protected $fillable = [
        'id',
        'name', 
        'description', 
        'status'
    ];
}
