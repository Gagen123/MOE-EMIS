<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExtraCurricularRoles extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_roles";

    protected $fillable = [
        'id',
        'Name', 
        'Description', 
        'Status'
    ];
}
