<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitor extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_visitor";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'visitorname',
        'designation',
        'contact',
        'minitsryOrAgency',
        'noOfhours',
        'targetgroup',
        'deptOrdivision',
        'purposeOfvisit',
        'dateOfVisit',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'







    ];
}
