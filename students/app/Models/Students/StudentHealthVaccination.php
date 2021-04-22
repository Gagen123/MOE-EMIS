<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHealthVaccination extends Model
{
    use HasFactory, Uuid;
    protected $table="std_health_vaccination";

    protected $fillable = [
        'id',
        'StdVaccineTypeId',
        'date',
        'class',
        'td_vaccine_at6_boys',
        'td_vaccine_at6_girls',
        'td_vaccine_at12_boys',
        'td_vaccine_at12_boys',
    ];
}
