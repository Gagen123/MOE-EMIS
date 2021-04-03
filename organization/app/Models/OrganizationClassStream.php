<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationClassStream extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_class_streams";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','classId','streamId','created_by','updated_by'
    ];
}
