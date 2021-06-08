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
use App\Models\structuralFacility\WashFeeding;
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
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * method to get category in dropdown
     */
    public function getCategoryInDropdown(){  
        return StructureCategory::where('status',1)->get();
    }

    /**
     * method to get structure Designer in dropdown
     */
    public function getDesignerDropdown(){
        return StructureDesigner::where('status',1)->get();
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
        return StructureFacility::where('status',1)->get();
    }
    /**
     * method to save sport details
     */
    public function saveInfrastructure(Request $request){
        $id = $request->id;
        if($id != null){
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
                'updated_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
                ];
                $infra = Infrastructure::where('id', $id)->update($infrastructure);
                DB::table('infrastructure_facilities')->where('infrastructureId', $request->id)->delete();
                foreach ($request->input('users') as $i=> $user){
                    $facilityInStructure = array(
                        'infrastructureId'              =>  $request->id,
                        'facilityTypeId'                =>  $user['facility'],
                        'facilityName'                  =>  $user['facilityNo'],
                        'capacity'                      =>  $user['capacity'],
                        'noOfFacility'                  =>  $user['noOfFacility'],
                        'noAccessibleToDisabled'        =>  $user['accessibleDisabled'],
                        'noWithInternetConnection'      =>  $user['internetConnection'],
                        'updated_by'                    =>  $request->user_id,
                        'created_at'                    =>  date('Y-m-d h:i:s')
                    );
                    $infra = FacilityInStructure::create($facilityInStructure);
                }
            return $this->successResponse($infra, Response::HTTP_CREATED);

        }else{
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
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
                ];

                $infra = Infrastructure::create($infrastructure);
                $infrastructureId = $infra->id;
    
                foreach ($request->input('users') as $i=> $user){
                    $facilityInStructure = array(
                        'infrastructureId'              =>  $infrastructureId,
                        'facilityTypeId'                =>  $user['facility'],
                        'facilityName'                  =>  $user['facilityNo'],
                        'capacity'                      =>  $user['capacity'],
                        'noOfFacility'                  =>  $user['noOfFacility'],
                        'noAccessibleToDisabled'        =>  $user['accessibleDisabled'],
                        'noWithInternetConnection'      =>  $user['internetConnection'],
                        'created_by'                    =>  $request->user_id,
                        'created_at'                    =>  date('Y-m-d h:i:s')
                );
                    $infra = FacilityInStructure::create($facilityInStructure);
                }
            return $this->successResponse($infra, Response::HTTP_CREATED);
        }
    }

    public function loadInfrastructureList($orgId=""){
        $list = DB::table('infrastructures as a')
            ->join('structure_category as b', 'b.id', '=', 'a.categoryId')
            ->join('structure_sub_categories as c', 'c.id', '=', 'a.subCategoryId')
            ->select('a.id AS id','b.name AS categorgName', 'c.subCategoryName AS subCategoryName',
            'a.structureNo AS structureNo','a.organizationId AS organizationId',
            'a.yearOfConstruction AS yearOfConstruction','a.plintchArea AS plintchArea',
            'a.noOfFloor AS noOfFloor','a.totalCapacity AS totalCapacity', 
            'a.rampAccess AS rampAccess', 'a.presentCondition AS presentCondition',
            'a.design AS design','a.categoryId AS categoryId','a.subCategoryId AS subCategoryId')
            ->where('organizationId',$orgId)->get();
        return $list;
    }

    public function getInfrastructureDetails($infraId=""){
        $response_data=Infrastructure::where('id',$infraId)->first();
        $response_data->facility=FacilityInStructure::where('infrastructureId',$response_data->id)->get();
        return $this->successResponse($response_data); 
    }

    
    public function saveWashFeeding(Request $request){
        // dd($request->questionList);
        $inserted_data ="";
        WashFeeding::where('orgId',$request->organizationId)->where('type',$request->type)->delete();
        foreach ($request->questionList as $i=> $question){
            $q_ans = array(
                'orgId'                         =>  $request->organizationId,
                'questionId'                    =>  $question['id'],
                'type'                          =>  $request->type,
                'ans_type'                      =>  $question['answer_type'],
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s')
            );
            if($question['answer_type']=="Checkbox" || $question['answer_type']=="Radio"){
                foreach ($question['ans_list'] as $i=> $subquest){
                    if(isset($subquest['answered'])==true){
                        if($subquest['answered']!=null && $subquest['answered']!=""){
                            $q_ans=array_merge($q_ans,
                                array( 'answer'   =>  $subquest['id'],)
                            );
                           $inserted_data = WashFeeding::create($q_ans);
                        }
                    }
                }
            }
            else if($question['answer_type']=="Text" || $question['answer_type']=="Number" || $question['answer_type']=="TextArea" || $question['answer_type']=="Dropdown"){
                if($question['answered']!=""){
                    $q_ans=array_merge($q_ans,
                        array( 'answer'   =>  $question['answered'],)
                    );
                    $inserted_data = WashFeeding::create($q_ans);
                }
            }
        }
        return $this->successResponse($inserted_data, Response::HTTP_CREATED);
    }

    public function getWashFeeding($type=""){
        $wash_feeding_detials=WashFeeding::where('type',explode('SSS',$type)[0])->where('orgId',explode('SSS',$type)[1])->get();
        return $this->successResponse($wash_feeding_detials); 
    }
}
