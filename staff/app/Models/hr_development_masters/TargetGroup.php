<?php

namespace App\Models\hr_development_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class TargetGroup extends Model{
    use HasFactory, Uuid;
    protected $table="master_target_group";
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
