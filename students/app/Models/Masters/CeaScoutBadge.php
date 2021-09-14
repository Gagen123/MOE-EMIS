<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaScoutBadge extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scout_proficiency_badges";

    protected $fillable = [
        'id',
        'CeaScoutSectionId',
        'Name',
        'Description', 
        'Code',
        'Status'
    ];
}
