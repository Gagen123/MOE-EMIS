<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FeederStudents extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="organization_feeder_students";

    protected $fillable = [
        'id', 
        'StdStudentId',
        'presentSchool',
        'StdName',
        'StdCode',
        'parentschool',
        'remarks',
        'created_by',
        'created_at'
    ];
}
