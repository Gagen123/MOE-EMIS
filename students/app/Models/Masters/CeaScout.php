<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaScout extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scouts";

    protected $fillable = [
        'id',
        'CeaScoutTypeId',
        'name',
        'status'
    ];
}
