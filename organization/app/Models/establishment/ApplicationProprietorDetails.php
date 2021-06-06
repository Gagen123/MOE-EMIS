<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationProprietorDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="application_proprietor_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationEstDetailsChangeId',
        'proprietorName',
        'proprietorCid',
        'proprietorMobile',
        'proprietorPhone',
        'proprietorEmail'
    ];
}
