<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class TransferConfigDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="master_staff_transfer_config_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'transfer_config_id',
        'sequence',
        'authority_type_id',
        'role_id'
    ];
}
