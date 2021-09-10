<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAwards extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_award";

    protected $fillable = [
        'id',
        'CeaAwardTypeId',
        'Name',
        'CeaAwardId',
        'CeaProgrammeId',
        'Description', 
        'Code',
        'Status'
    ];
}

