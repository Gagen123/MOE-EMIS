<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeadQuaterDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="head_quater_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','organizationId',
        'zestAgencyCode',
        'agencyName',
        'organizationType',
        'dzongkhagId',
        'gewogId',
        'chiwogId',
        'status',
        'created_by',
        'updated_by'
    ];
}
