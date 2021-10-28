<?php

namespace App\Models\mess_manage;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionTable extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="mess_transaction_table";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'organizationId',
        'item_id',
        'procured_type',
        'available_qty',
        'issue_qty',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
