<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationProprietorDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_proprietor_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','organizationId','cid','fullName','phoneNo','email','created_by','updated_by'
    ];
}
