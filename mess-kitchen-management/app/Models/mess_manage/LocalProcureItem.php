<?php

namespace App\Models\mess_manage;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalProcureItem extends Model
{
    //
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="local_procure_item";

    protected $fillable = [
        'id',
        'organizationId',
        'dateOfprocure',
        'item_id',
        'quantity',
        'unit_id',
        'amount',
        'remark',
        'food_source',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
