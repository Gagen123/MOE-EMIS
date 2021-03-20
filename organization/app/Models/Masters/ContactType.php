<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    //
    public $timestamps = false; // to disable created_at and updated_at
    protected $table = "org_contact_type";

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Id','Name', 'DisplayOrder', 'Status'
    ];
}
