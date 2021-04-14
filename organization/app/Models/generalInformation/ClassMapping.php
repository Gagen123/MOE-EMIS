<?php

namespace App\Models\generalInformation;;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassMapping extends Model
{
    use HasFactory, Uuid;
    protected $table="class_mappings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','organizationId','classId','created_by','updated_by'
    ];
}
