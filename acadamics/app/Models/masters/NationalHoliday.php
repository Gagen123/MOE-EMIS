<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NationalHoliday extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_national_holiday";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'holiday_date',
        'description', 
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
