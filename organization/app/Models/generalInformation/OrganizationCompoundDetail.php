<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationCompoundDetail extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="organization_compound_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'thramNo',
        'plotNo',
        'attachments',
        'compoundArea',
        'playgroundArea',
        'playgroundAreaUsable',
        'status',
        'statusofplay',
        'programType',
        'agricultureArea',
        'agricultureAreaUsed',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

}
