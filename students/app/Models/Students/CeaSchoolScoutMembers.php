<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaSchoolScoutMembers extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scouts_membership";

    protected $fillable = [
        'id',
        'CeaSchoolScoutsId',
        'StdStudentId',
        'JoiningDate'
    ];

}
