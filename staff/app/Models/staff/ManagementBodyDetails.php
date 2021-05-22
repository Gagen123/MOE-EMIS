<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class ManagementBodyDetails extends Model{
    use HasFactory, Uuid;
    protected $table="stf_mgmn_body_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'body_type_id',
        'from_date',
        'to_date',
        'org_id',
        'dzongkhag_id',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
