<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationFinancialInformation extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="orgnization_financial_informations";

    protected $fillable = [
        'id',
        'organizationId',
        'financialInformationId',
        'amount',
        'date',
        'remarks'
    ];

}
