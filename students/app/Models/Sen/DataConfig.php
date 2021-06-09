<?php

namespace App\Models\Sen;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataConfig extends Model
{
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="sen_data_config";
    protected $fillable = [
        'id',
        'name',
        'start_date',
        'end_date',
        'remarks',
        'isactive',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by'
    ];
}
