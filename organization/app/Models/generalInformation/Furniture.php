<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Furniture extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_furniture";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'type', 
        'item', 
        'cost',
        'number',
        'locationUse',
        'lifeExpectancy',
        'dateReceived', 
        'condition',
        'created_by',
        'updated_by'
    ];
}
