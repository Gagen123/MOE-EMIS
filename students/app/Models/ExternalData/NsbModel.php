<?php

namespace App\Models\ExternalData;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NsbModel extends Model{
    use HasFactory, Uuid;
    protected $table="external_data_nsb";
    protected $fillable = [
        'id',
        'year',
        'age_group',
        'male',
        'female',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at'
    ];
}
