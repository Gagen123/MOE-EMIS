<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaRoleStaff extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_role_staff";

    protected $fillable = [
        'id',
        'CeaRoleId',
        'CeaSchoolProgrammeId',
        'StfStaffId',
        'Remarks'
    ];
}
