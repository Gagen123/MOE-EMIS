<?php

namespace App\Models\office_order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class TransferOrder extends Model{
    use HasFactory, Uuid;
    protected $table="office_order";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'type',
        'order_no',
        'staff_id',
        'reason',
        'remarks',
        'status',
        'reject_approve_Date',
        'rejected_approved_by',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
