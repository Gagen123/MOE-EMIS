<?php

namespace App\Models\restructuring;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bifurcation extends Model
{
    use HasFactory, Uuid;
    protected $table="bifurcations";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','new1Name','new1Level','new1Category','new1Dzongkhag','new1Gewog','new1Chiwog','new1Location',
        'new1IsGeoLocated','new1IsSenSchool','new1IsCoLocated','new1ParentSchool',
        'new2Name','new2Level','new2Category','new2Dzongkhag','new2Gewog','new2Chiwog','new2Location',
        'new2IsGeoLocated','new2IsSenSchool','new2IsCoLocated','new2ParentSchool',
    ];
}
