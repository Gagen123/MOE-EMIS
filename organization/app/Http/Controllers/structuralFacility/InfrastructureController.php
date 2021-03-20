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
        // if( $id != null){
        //     $sport = [
        //         'organizationId'                        =>  $request['organizationId'],
        //         'facility'                              =>  $request['facility'],
        //         'type'                                  =>  $request['type'],
        //         'yearOfEstablishment'                   =>  $request['yearOfEstablish'],
        //         'status'                                =>  $request['status'],
        //         'supportedBy'                           =>  $request['supportedBy'],
        //         'noOfFacility'                          =>  $request['numberOfFacility'], 
        //         'accessibleToDisabled'                  =>  $request['facilityAccessibleToDisabled'],
        //     ];
        //     $spo = Sport::where('id', $id)->update($sport);
        // }else{
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

            foreach ($request->input('users') as $i=> $user){
                $facilityInStructure = array(
                    'infrastructureId'        =>  $request[1],
                    'facility'                =>  $request['facility'],
                    'type'                    =>  $user['type'],
                    'facilityNo'              =>  $user['facilityNo'],
                    'capacity'                =>  $user['capacity'],
                    'noOfFacility'            =>  $user['noOfFacility'],
                    'accessibleDisabled'      =>  $user['accessibleDisabled'],
                    'internetConnection'      =>  $user['internetConnection'],
            );
                 $infra = ContactDetails::create($facilityInStructure);
            }
        // }
        return $this->successResponse($infra, Response::HTTP_CREATED);
    }
}
