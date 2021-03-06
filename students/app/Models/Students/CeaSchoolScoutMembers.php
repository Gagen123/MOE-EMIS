<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaSchoolScoutMembers extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scout_membership";

    protected $fillable = [
        'id',
        'StdStudentId',
        'CeaScoutSectionId',
        'CeaScoutSectionLevelId',
        'joiningDate',
        'responsibility',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

}
