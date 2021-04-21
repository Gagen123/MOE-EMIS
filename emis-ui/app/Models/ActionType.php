<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    use HasFactory;
    protected $table="t_actiontype_master";
    protected $fillable = [
        'action_name',
        'action_description',
        'status'
    ];
}
