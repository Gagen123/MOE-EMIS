<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaScoutBadge extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scout_proficiency_badge";

    protected $fillable = [
        'id',
        'CeaScoutSectionLevelId',
        'Name',
        'Description', 
        'Code',
        'Status'
    ];
}
