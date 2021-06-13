<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaClubMembership extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="cea_club_membership";

    protected $fillable = [
        'id',
        'CeaSchoolProgrammeId',
        'StdStudentId', 
        'Responsibility',
        'JoiningDate',
        'Achievement',
        'Role',
        'Status'
    ];
}
