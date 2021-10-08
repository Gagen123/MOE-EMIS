<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Institute extends Model{
    use HasFactory, Uuid;
    protected $table="master_stf_qualification_institute";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
