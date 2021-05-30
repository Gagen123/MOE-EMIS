<?php

namespace App\Models\staff_service_masters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class StaResponsiblity extends Model
{
    use HasFactory, Uuid;
    protected $table="master_staff_responsibility";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}