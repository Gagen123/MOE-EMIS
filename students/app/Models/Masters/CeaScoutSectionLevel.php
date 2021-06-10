<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaScoutSectionLevel extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_scout_section_level";

    protected $fillable = [
        'id',
        'CeaScoutSectionId',
        'name',
        'description',
        'status'
    ];
}
