<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramItem extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_item";

    protected $fillable = [
        'id',
        'Name', 
        'Description', 
        'Status'
    ];
}
