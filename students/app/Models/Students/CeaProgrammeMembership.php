<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgrammeMembership extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_membership";

    protected $fillable = [
        'id',
        'CeaSchoolProgrammeId',
        'StdStudentId',
        'JoiningDate',
        'Responsibility',
        'Achievement'
    ];
}
