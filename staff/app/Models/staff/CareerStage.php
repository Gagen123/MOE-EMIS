<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class CareerStage extends Model{
    use HasFactory, Uuid;
    protected $table="staff_career_stages";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'staff_id',
        'currier_stage',
        'remarks',
        'created_by',
        'created_at',
    ];
}
