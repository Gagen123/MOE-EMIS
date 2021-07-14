<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class CounsellingProgram extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="std_counselling_programs";

    protected $fillable = [
        'id',
        'activities', 
        'issues',
        'organizationId',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
