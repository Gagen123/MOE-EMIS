<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramItemVariety extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_item_variety";

    protected $fillable = [
        'id',
        'Name',
        'UnitId',
        'Description',
        'Code',
        'Status'
    ];
}
