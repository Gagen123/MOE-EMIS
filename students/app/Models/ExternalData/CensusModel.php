<?php

namespace App\Models\ExternalData;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CensusModel extends Model{
    use HasFactory, Uuid;
     protected $table="external_data_census";
     protected $fillable = [
        'id',
        'year',
        'age',
        'male',
        'female',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at'
     ];
}
