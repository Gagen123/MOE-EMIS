<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationFeedingDetails extends Model
{
    use HasFactory,Uuid;
    protected $table="organization_feeding_detials";

    protected $fillable = [
        'id',
        'organizationId',
        'noOfMeals',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
