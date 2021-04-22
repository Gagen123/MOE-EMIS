<?php

namespace App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StudentPersonalDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="std_personal_detils";
    protected $fillable = [
        'id',
        'snationality',
        'cid_passport',
        'first_name','middle_name','last_name',
        'dob','sex_id',
        'village_id','address',
        'mother_tongue',
        'attachments',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
