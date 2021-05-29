<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRole extends Model
{
    use HasFactory, Uuid;
    protected $table="std_role";

    protected $fillable = [
        'id',
        'Name', 
        'Description', 
        'Status'
    ];
}
