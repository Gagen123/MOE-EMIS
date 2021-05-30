<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramInventoryExpenditure extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_inventory_expenditure";

    protected $fillable = [
        'id',
        'CeaProgrammeInventoryId',
        'Particular',
        'Amount',
        'Remarks'
    ];
}