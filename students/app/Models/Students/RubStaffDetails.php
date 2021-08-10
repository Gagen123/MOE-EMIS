<?php

namespace App\Models\Students;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RubStaffDetails extends Model
{
    //
    //
    use HasFactory, Uuid;
    protected $table="rub_staff_details";
    protected $fillable = [
        'id',
        'staffName',
        'institute_id',
        'staffEmail',
        'staff_contactNo',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at'
    ];
}
