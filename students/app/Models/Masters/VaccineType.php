<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaccineType extends Model
{
    use HasFactory, Uuid;
    protected $table="std_vaccine_type";

    protected $fillable = [
        'id',
        'Name', 
        'vaccineFor',
        'Description',
        'Code',
        'Status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
