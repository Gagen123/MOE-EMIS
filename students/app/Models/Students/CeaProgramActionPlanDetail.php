<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramActionPlanDetail extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_action_plan_detail";

    protected $fillable = [
        'id',
        'CeaProgrammeActionPlanId',
        'Title',
        'Description'
    ];
}