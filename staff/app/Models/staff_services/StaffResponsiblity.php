<?php

namespace App\Models\staff_services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class StaffResponsiblity extends Model{
    use HasFactory, Uuid;
    protected $table="staff_responsibilities";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'staff_id',
        'responsibility',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
