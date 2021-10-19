<?php

namespace App\Models\staff_leadership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class Capability extends Model{
    use HasFactory, Uuid;
    protected $table="master_capability";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'category',
        'name',
        'code',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
