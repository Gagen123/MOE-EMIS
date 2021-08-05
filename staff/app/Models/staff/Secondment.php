<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class Secondment extends Model{
    use HasFactory, Uuid;
    protected $table="staff_secondment";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'staff_id',
        'secondment_id',
        'from_date',
        'to_date',
        'agency',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
