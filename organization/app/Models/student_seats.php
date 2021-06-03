<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class student_seats extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="student_seats";
    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'year',
        'no_of seats',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
