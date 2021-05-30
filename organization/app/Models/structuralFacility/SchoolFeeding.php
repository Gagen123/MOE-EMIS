<?php

namespace App\Models\structuralFacility;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolFeeding extends Model
{
    use HasFactory, Uuid;
    protected $table="school_feedings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','organizationId','description','value','status','type','created_by','updated_by'
    ];
}
