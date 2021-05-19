<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramInventoryProduction extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_inventory_production";

    protected $fillable = [
        'id',
        'CeaProgrammeInventoryId',
        'CeaProgrammeInventoryItemId',
        'QuantityProduced',
        'NoOfVariety',
        'AmountGenerated',
        'Remarks'
    ];
}