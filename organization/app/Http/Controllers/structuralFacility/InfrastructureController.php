<?php

namespace App\Http\Controllers\structuralFacility;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\structuralFacility\Infrastructure;
use App\Models\Masters\StructureCategory;
use App\Models\Masters\StructureSubCategory;
use App\Models\Masters\StructureFacility;
use App\Models\Masters\StructureDesigner;
use App\Models\structuralFacility\FacilityInStructure;
use Illuminate\Support\Facades\DB;


class InfrastructureController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * method to get category in dropdown
     */
    public function getCategoryInDropdown(){
        return StructureCategory::get(['id','name']);
    }

    /**
     * method to get structure Designer in dropdown
     */
    public function getDesignerDropdown(){
        return StructureDesigner::get(['id','name']);
    }

    /**
     * method to get subCategory in dropdown by category
     */
    public function getSubCategoryInDropdown($categoryId){
        $equi = DB::table('structure_sub_categories as a')
            ->select('a.id as id', 'a.subCategoryName as subCategoryName')
            ->where('structureCategory','=',$categoryId)
            ->get();
        return $equi;
    }

    /**
     * method to get category in dropdown
     */
    public function getStructureFacilityInDropdown(){
        return StructureFacility::get(['id','name']);
    }
    /**
     * method to save sport details
     */
    public function saveInfrastructure(Request $request){
        $id = $request->id;

            $infrastructure = [
            'organizationId'            =>  $request['organizationId'],
            'categoryId'                =>  $request['category'],
            'subCategoryId'             =>  $request['subCategory'],
            'structureNo'               =>  $request['structureNo'],
            'yearOfConstruction'        =>  $request['yearOfConstruction'],
            'plintchArea'               =>  $request['plintchArea'],
            'noOfFloor'                 =>  $request['noOfFloor'], 
            'totalCapacity'             =>  $request['totalCapacity'],
            'rampAccess'                =>  $request['rampAccess'],
            'presentCondition'          =>  $request['presentCondition'],
            'design'                    =>  $request['design'],
            ];
            
            $infra = Infrastructure::create($infrastructure);
            $infrastructureId = DB::table('infrastructures')->orderBy('id','desc')->limit(1)->pluck('id');

            foreach ($request->input('users') as $i=> $user){
                $facilityInStructure = array(
                    'infrastructureId'              =>  $infrastructureId[0],
                    'facilityTypeId'                =>  $user['facility'],
                    'typeId'                        =>  $user['type'],
                    'facilityName'                  =>  $user['facilityNo'],
                    'capacity'                      =>  $user['capacity'],
                    'noOfFacility'                  =>  $user['noOfFacility'],
                    'noAccessibleToDisabled'        =>  $user['accessibleDisabled'],
                    'noWithInternetConnection'      =>  $user['internetConnection'],
            );
                $infra = FacilityInStructure::create($facilityInStructure);
            }
        return $this->successResponse($infra, Response::HTTP_CREATED);
    }

    public function loadInfrastructureList(){

        $list = DB::table('infrastructures as a')
            ->join('structure_category as b', 'b.id', '=', 'a.categoryId')
            ->join('structure_sub_categories as c', 'c.id', '=', 'a.subCategoryId')
            ->select('a.id AS id','b.name AS categorgName', 'c.subCategoryName AS subCategoryName',
            'a.structureNo AS structureNo','a.organizationId AS organizationId',
            'a.yearOfConstruction AS yearOfConstruction','a.plintchArea AS plintchArea',
            'a.noOfFloor AS noOfFloor','a.totalCapacity AS totalCapacity', 
            'a.rampAccess AS rampAccess', 'a.presentCondition AS presentCondition',
            'a.design AS design','a.categoryId AS categoryId','a.subCategoryId AS subCategoryId')->get();
        return $list;
    }
}
