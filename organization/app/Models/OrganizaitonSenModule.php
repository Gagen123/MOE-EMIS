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
        'org_id',
        'accessibleToilet',
        'accessibleWash' ,
        'outdoorPlayground',
        'outdoorRoutes' ,
        'girlsHostelAccessible' ,
        'diningHall'  ,
        'hostelWash'  ,
        'boysHostelAccessible'  ,
        'enrollment'   ,
        'communityWithDisablities',
        'community'   ,
        'senProgram'   ,
        'studentDisabilities',
        'proprietorName',
        'professionalsSupportChildren',
        'adultWorkingwithChildren' ,
        'support_disabilitycommunity' ,
        'matrons' ,
        'wardens',
        'caregivers',
        'disabilitiesInHostal',
        'user_id', 
        'created_by',
        'updated_by'
    ];
}
