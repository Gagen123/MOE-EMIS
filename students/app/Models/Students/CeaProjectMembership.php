<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProjectMembership extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_project_membership";

    protected $fillable = [
        'id',
        'StdStudentId',
        'CeaProjectId',
        'Task',
    ];
}
