<?php

namespace App\Models\Students;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RubCollegeDetails extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="rub_college_details";

    protected $fillable = [
        'id',
        'collegeName',
        'dzongkhag',
        'institutes_type',
        'org_id',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at'
    ];
}
