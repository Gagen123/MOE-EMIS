<?php

namespace App\Models;
use App\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ClassXiAdmission extends Model
{
    //
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="class_xi_admissions";
    protected $fillable = [
        'id',
        'std_id',
        'org_id',
        'dzo_id',
        'class_id',
        'stream_id',
        'dateOfapply',
        'remarks',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
