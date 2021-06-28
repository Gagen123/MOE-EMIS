<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class TransferConfig extends Model
{
    use HasFactory, Uuid;
    protected $table="master_staff_transfer_config";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'transfer_type_id',
        'submitter_role_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
