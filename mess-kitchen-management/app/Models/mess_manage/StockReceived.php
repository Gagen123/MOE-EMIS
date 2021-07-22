<?php

namespace App\Models\mess_manage;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockReceived extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="stock_receiveds";
    protected $fillable = [
        'id',
        'organizationId',
        'dzo_id',
        'dateOfreceived',
        'quarter_id',
        'remarks',
        'status',
        'approve_reject_remarks',
        'created_by',
        'updated_by',
        'updated_at',
        'created_at',
        'approve_reject_by',
        'approve_reject_at',

    ];
}
