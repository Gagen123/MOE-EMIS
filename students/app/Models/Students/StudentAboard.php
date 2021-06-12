<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAboard extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="student_aboards";

    protected $fillable = [
        'id',
        'organizationId',
        'cid_passport',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'sex_id',
        'mother_tongue',
        'status' ,
        'fulladdress',
        'country',
        'city',
        'phone',
        // 'created_by',
        // 'updated_by'
    ];
}


