<?php

namespace App\Models\staff;
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
        'organizationId',
        'name',
        'DateOfBirth',
        'dzongkhag',
        'gewog',
        'village',
        'presentAddress',
        'EmailAddress',
        'application_no',
        'contact_number',
        'application_for',
        'application_type',
        'action_type',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}

