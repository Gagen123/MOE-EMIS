<?php

namespace App\Models\structuralFacility;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sport extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_sports";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'organizationId', 'facility', 
        'type','number','yearOfEstablishment','accessibleToDisabled','size',
        'status','sportstype','supportedBy',
        'created_by',
        'updated_by', 'created_at', 'updated_at'
    ];
}

