<?php

namespace App\Models\staff;   
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class SubstitutedTeacher extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="substituted_teachers";
    public $timestamps = false;
    protected $fillable = [
    'id',
    'staff_id',
    'subsTeacher',
    'from_date',
    'to_date',
    'remarks',
    'teaching_subject',
    'isextended',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at',
    ];
}
