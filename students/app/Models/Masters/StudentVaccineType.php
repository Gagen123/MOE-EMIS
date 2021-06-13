<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentVaccineType extends Model
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $table="std_vaccine_type";
    protected $fillable = [
        'id',
        'name',
        'status',
        'description',
        'vaccineFor',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
