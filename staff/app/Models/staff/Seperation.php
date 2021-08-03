<?php

namespace App\Models\staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class Seperation extends Model{
    use HasFactory, Uuid;
    protected $table="staff_seperation";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'staff_id',
        'seperation_id',
        'from_date',
        'to_date',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
