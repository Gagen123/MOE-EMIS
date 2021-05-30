<?php

namespace App\Models\Masters;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpBenefit extends Model
{
    use HasFactory, Uuid;
    protected $table="master_student_benefit";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'Name',
        'Status',
        'created_by', 
        'created_at',
        'updated_by',
        'updated_at'
    ];
}