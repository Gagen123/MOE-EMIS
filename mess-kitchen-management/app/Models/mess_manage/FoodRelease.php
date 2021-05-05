<?php

namespace App\Models\mess_manage;

use Illuminate\Database\Eloquent\Model;

class FoodRelease extends Model
{
    use HasFactory, Uuid;
    protected $table="foodreleases";

    protected $fillable = [
        'id','organizationId','date','dzongkhag','school','quarter','created_by','updated_by'
    ];

}
