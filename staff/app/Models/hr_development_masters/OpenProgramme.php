<?php

namespace App\Models\hr_development_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class OpenProgramme extends Model{
    use HasFactory, Uuid;
    protected $table="hr_developmnt_programme_calander";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'staff_id',
        'start_date',
        'end_date',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
