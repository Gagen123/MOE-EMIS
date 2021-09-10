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
        'Name',
        'Status',
        'Description',
        'Code',
        'vaccineFor',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
