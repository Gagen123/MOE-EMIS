<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHealth extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="student_healths";

    protected $fillable = [
        'id','name', 'status'
    ];
}

