<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffenceSeverity extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="std_disciplinary_severity";

    protected $fillable = [
        'id',
        'Name', 
        'Description', 
        'Status'
    ];
}
