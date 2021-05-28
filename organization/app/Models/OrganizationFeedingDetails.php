<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationFeedingDetails extends Model
{
    use HasFactory;
    protected $table="organization_feeding_detials";

    protected $fillable = [
        'id',
        'organizationId',
        'noOfMeals'
    ];
}
