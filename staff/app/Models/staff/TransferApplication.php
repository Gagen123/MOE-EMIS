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
        'transfer_type_id',
        'aplication_number',
        'transfer_window_id',
        'staff_id',
        'transfer_reason_id',
        'transferType',
        'description',
        'status',
        'preference_school',
        'dzongkhagApproved',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        
    ];
}
