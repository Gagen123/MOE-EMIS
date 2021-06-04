<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class organization_financial_information extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="orgnization_financial_informations";

    protected $fillable = [
        'id',
        // 'organizationId',
        // 'financialInformationId',
        // 'type',
        'amount',
        'date',
        'status'
    ];

}
