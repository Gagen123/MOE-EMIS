<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class OrganizaitonSenModule extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_sen_detail";

    protected $fillable = [
        'id',
        'org_id',
        'newConstruction',
        'adjustmentsAccomodatte',
        // 'accessibleToilet',

        'outdoorPlayground',
        'outdoorRoutes',

        'girlsHostelAccessible',
        'diningHall',
        'hostelWash',
        'boysHostelAccessible',

        'enrollment',
        'proprietorName',
        'communityWithDisablities',
        'community' ,

        'senProgram',
        'studentDisabilities',

        'professionalsSupportChildren',
        'adultWorkingwithChildren',
        'supportDisabilitycommunity',
        'supportService',
        'schoolEndrosed',
        'disabledGraduated',
        'disabledMovedToOtherSchool',
        'disabledTransaction',
        'disabledDropOut',
        'disabilitiesDropoutCurrenly',
        'disabledTransactionLastYear',
        'caregivers',
        'disabilitiesInHostal',
        'created_by',
        'updated_by'
    ];
}
