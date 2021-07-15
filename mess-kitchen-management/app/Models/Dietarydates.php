<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Dietarydates extends Model{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="dietary_dates";
    protected $fillable = [
        'id',
        'basic_id',
        'record_date',
        'total_score',
    ];
}
