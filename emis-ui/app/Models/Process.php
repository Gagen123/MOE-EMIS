<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    protected $table="t_process_master";
    protected $fillable = [
        'process_name',
        'process_description',
        'status'
    ];
}
