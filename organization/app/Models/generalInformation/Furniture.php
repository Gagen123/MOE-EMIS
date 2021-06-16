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
        'usable',
        'notusable',
        'created_by',
        'updated_by'
    ];
}
