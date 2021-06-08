<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_equipment";

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
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
