<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class organization_income_facilities extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_income_facilities";
    protected $fillable = [
        'id',
        // 'organizationId',
        // 'financialInformationId',
        // 'type',
        'amountgenerated',
        'date',
        'remarks'
    ];
}
