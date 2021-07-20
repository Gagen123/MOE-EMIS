<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramInventoryDetail extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_inventory_detail";

    protected $fillable = [
        'id',
        'CeaProgrammeInventoryId',
        'PreviousQty',
        'CeaProgrammeInventoryItemId',
        'IncreaseInQuantity',
        'DecreaseInQuantity',
        'Remarks'
    ];
}
