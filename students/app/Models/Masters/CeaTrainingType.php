<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaTrainingType extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_training_type";

    protected $fillable = [
        'id',
        'Name', 
        'Status'
    ];
}
