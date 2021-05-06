<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramApplication extends Model
{
    use HasFactory, Uuid;
    protected $table="program_application";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'program_id',
        'org_id',
        'dzo_id',
        'app_no',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
