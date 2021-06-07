<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eccd extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="eccds";

    protected $fillable = [
        'id','organizationId','facility','yearOfEstablishment','status','supportedBy','noOfFacility',
       'created_by','updated_by'
    ];

}
