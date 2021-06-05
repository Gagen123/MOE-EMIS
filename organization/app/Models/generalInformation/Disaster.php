<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disaster extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_disasters";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'disasterTypeId',
        'diastercomm',
        'name',
        'cid',
        'sex_id',
        'email',
        'contactNo',
        'servingAs',
        'placeOfWork'
    ];
}
