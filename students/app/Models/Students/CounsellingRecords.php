<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class CounsellingRecords extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="counselling_records";

    protected $fillable = [
        'id',
        'counselling_type', 
        'number',
        'remarks',
        'organizationId',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
