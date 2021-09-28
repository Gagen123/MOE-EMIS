<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization_AnnualData extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="organization_annualdata";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'year',
        'status',
        'date',
        'created_by',
        'created_at',
        
    ];
} 
