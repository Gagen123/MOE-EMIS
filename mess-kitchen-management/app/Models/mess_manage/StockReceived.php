<?php

namespace App\Models\mess_manage;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockReceived extends Model
{
    use HasFactory, Uuid;
    protected $table="stock_receiveds";

    protected $fillable = [
        'id',
        'dateOfreceived',
        'quarter',
        'item',
        'receivedquantity',
        "'pending'+index'",
        'unit',
        'remarks',
        'created_by',
        'updated_by'
    ];
}
