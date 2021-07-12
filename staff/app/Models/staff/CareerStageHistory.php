<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CareerStageHistory extends Model{
    use HasFactory;
    protected $table="staff_career_stages_history";
    public $timestamps = false;
    protected $fillable = [
        'record_id',
        'id',
        'staff_id',
        'currier_stage',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'recorded_by',
        'recorded_at',
    ];
}
