<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Feeder extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="organization_feeder";

    protected $fillable = [
        'id', 
        'feederschool',
        'orgId',
        'class',
        'parentschool',
        'remarks',
        'created_by',
        'created_at'
    ];
}
