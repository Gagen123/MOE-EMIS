<?php

namespace App\Models\global_masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Country extends Model{
    use HasFactory, Uuid;
    protected $table="country_master";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'country_name',
        'nationality',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
