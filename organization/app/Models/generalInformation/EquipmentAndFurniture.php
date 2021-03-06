<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentAndFurniture extends Model
{
    use HasFactory, Uuid;
    protected $table="equipment_and_furniture";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','organizationId','type', 'item', 'location', 'number','created_by','updated_by'
    ];
}
