<?php

namespace App\Models\Students;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class notenrolled_admimission extends Model
{
    //
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="notenrolled_adminstration";
    protected $fillable = [
        'id',
        'std_id',
        'org_id',
        'dzo_id',
        'class_id',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
