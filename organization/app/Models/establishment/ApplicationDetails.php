<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="application_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'application_no',
        'establishment_type',
        'category',
        'dzongkhagId',
        'gewogId',
        'chiwogId',
        'application_type',
        'year',
        'status',
        'remarks',
        'created_by'
    ];
}
