<?php

namespace App\Models\mess_manage;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockIssued extends Model
{
    use HasFactory, Uuid;
    protected $table="stock_issueds";

    protected $fillable = [
        'id',   
        'organizationId',                         
        'dateOfissue',
        'quantity',
        'item_id',
        'quantity',
        'unit_id',
        'damagequantity',
        'remarks',
        'created_by',
        'updated_by'
    ];
}

