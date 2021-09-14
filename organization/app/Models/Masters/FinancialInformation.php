<?php

namespace App\Models\Masters;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialInformation extends Model
{
    use HasFactory, Uuid;
    protected $table="master_financial_information";
    protected $fillable = [
        'id','name','code','applicableTo', 'description', 'status','created_by','updated_by'
    ];
}
