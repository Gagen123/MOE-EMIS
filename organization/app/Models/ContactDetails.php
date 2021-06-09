<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="contact_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'phone',
        'email',
        'facebookLink',
        'website'
    ];
}
