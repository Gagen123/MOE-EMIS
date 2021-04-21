<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaRole extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_role";

    protected $fillable = [
        'id',
        'CeaProgrammeId',
        'name',
        'assigned_to',
        'description', 
        'status'
    ];
}