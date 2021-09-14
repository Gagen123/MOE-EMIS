<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgram extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme";

    protected $fillable = [
        'id',
        'CeaProgrammeTypeId',
        'Name',
        'CeaProgrammeId',
        'Description',
        'Code',
        'status'
    ];
}
