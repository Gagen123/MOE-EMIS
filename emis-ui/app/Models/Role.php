<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table="t_role_master";
    protected $fillable = [
        'role_name',
        'role_description',
        'status'
    ];
}
