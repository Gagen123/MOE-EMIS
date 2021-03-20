<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locations extends Model
{
    use HasFactory, Uuid;
    protected $table="locations";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','organizationId','landOwnership','compoundFencing','entranceGate','longitude','latitude','altitude',
        'thramNo','cid','name','compoundArea'
    ];
}
