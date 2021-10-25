<?php

namespace App\Models\staff_services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class StaffDisaplinary extends Model{
    use HasFactory, Uuid;
    protected $table="staff_disaplinary";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'staff_id',
        'offence_date',
        'offence_type_id',
        'case_type',
        'case_category',
        'record_type',
        'offence_description',
        'description_on_action',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
