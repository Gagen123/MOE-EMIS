<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class TransferApplication extends Model{
    use HasFactory, Uuid;
    protected $table="transfer_application";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aplication_number',
        'transfer_window_id',
        'staff_id',
        'transfer_reason_id',
        'description',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status',
        'dzongkhagApproved'
    ];
}