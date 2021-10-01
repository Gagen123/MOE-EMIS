<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class ContractCategory extends Model{
    use HasFactory, Uuid;
    protected $table="master_contract_category";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'status',
        'code',
        'description',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
