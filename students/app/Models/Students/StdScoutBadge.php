<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StdScoutBadge extends Model
{
    use HasFactory, Uuid;
    protected $table="std_scout_proficiency_badges";

    protected $fillable = [
        'id',
        'CeaScoutProficiencyBadgeId',
        'StdStudentId',
        'date',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'

    ];
}
