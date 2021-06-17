<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProjectMember extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="cea_project_membership";

    protected $fillable = [
        'id',
        'StdStudentId',
        'CeaProjectId',
        'Task',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by'
    ];
}
