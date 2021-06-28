<?php

namespace App\Models\structuralFacility;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ECCDFacilities extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="eccd_facilities";
    protected $fillable = [
        'id','orgId','questionId','answer','type','ans_type','created_by','updated_by'
    ];


}
