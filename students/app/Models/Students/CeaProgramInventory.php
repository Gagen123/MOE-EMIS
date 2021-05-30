<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramInventory extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_inventory";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'CeaProgrammeId',
        'ForMonth',
        'Remarks'
    ];
}