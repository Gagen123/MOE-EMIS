<?php

namespace App\Models\mess_manage;
use App\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalProcure extends Model
{
    use HasFactory, Uuid;
    protected $table="local_procures";

    protected $fillable = [
        'id',
        'dateOfprocure',
        'item',
        'quantity',
        'unit',
        'amount',
        'remark',
        'created_by',
        'updated_by'
    ];
}
