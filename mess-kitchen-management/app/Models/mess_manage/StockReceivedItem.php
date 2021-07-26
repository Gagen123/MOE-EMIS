<?php

namespace App\Models\mess_manage;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockReceivedItem extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="stock_received_items";

    protected $fillable = [
        'id',
        'stockreceivedId',
        'item_id',
        'receivedquantity',
        'unit_id',
        'damagequantity',
        'remarks',
        'created_by',
        'updated_by'
    ];

}
