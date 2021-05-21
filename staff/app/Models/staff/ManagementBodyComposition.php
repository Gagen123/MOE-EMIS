<?php

namespace App\Models\staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class ManagementBodyComposition extends Model
{
    use HasFactory, Uuid;
    protected $table="stf_mgmn_body_composition";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'management_id',
        'emptye',
        'name',
        'designation',
        'phone',
        'email',
        'address',
        'from_date',
        'to_date',
    ];
}
