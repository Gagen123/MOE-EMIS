<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class TransPrefenreces extends Model{
    use HasFactory, Uuid;
    protected $table="transfer_preferemce_application";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'transfer_application_id',
        'transferType',
        'transfer_type_id',
        'dzongkhag_id',
        'school_id',
        'preference',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
