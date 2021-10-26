<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class CaseCategory extends Model
{
    use HasFactory, Uuid;
    protected $table="master_case_category";//master_staff_offence_severity
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'type',
        'code',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
