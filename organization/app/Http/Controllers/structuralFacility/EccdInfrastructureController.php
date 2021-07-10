<?php

namespace App\Http\Controllers\structuralFacility;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\Masters\StructureFacility;
use App\Models\Masters\StructureDesigner; 
use App\Models\Masters\ECCDStructureType;
use App\Models\Masters\ECCDFacilities;
use App\Models\structuralFacility\eccdInfrastructure;
use App\Models\structuralFacility\eccdInfrastructurefacility;

use Illuminate\Support\Facades\DB;



class EccdInfrastructureController extends Controller
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
     * method to save sport details
     */
    public function saveEccdInfrastructure(Request $request){
        $id = $request->id;
        if($id != null){
            $infrastructure = [
                'organizationId'            =>  $request['organizationId'],
                'structuretype'             =>  $request['structuretype'],
                'constructionType'          =>  $request['constructionType'],
                'yearOfConstruction'        =>  $request['yearOfConstruction'],
                'plintchArea'               =>  $request['plintchArea'],
                'noOfFloor'                 =>  $request['noOfFloor'],
                'totalCapacity'             =>  $request['totalCapacity'],
                'presentCondition'          =>  $request['presentCondition'],
                'design'                    =>  $request['design'],
                'id'                        =>  $request['id'],
                'updated_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
                ];
                $infra = eccdInfrastructure::where('id', $id)->update($infrastructure);
                DB::table('eccd_infrastructure_facilities')->where('eccdinfrastructureId', $request->id)->delete();
                foreach ($request->input('users') as  $i=> $facility){
                  
                    $facilityInStructure = array(
                        'eccdinfrastructureId'          =>  $request->id,
                        'facilityTypeId'                =>  $facility['facility'],
                        'facilityName'                  =>  $facility['facilityNo'],
                        'capacity'                      =>  $facility['capacity'],
                        'noOfFacility'                  =>  $facility['noOfFacility'],
                        'noAccessibleToDisabled'        =>  $facility['accessibleDisabled'],
                        'noWithInternetConnection'      =>  $facility['internetConnection'],
                        'updated_by'                    =>  $request->user_id,
                        'created_at'                    =>  date('Y-m-d h:i:s')
                    );
                    $infra = eccdInfrastructurefacility::create($facilityInStructure);
                }
            return $this->successResponse($infra, Response::HTTP_CREATED);

        }else{
            $infrastructure = [
                'organizationId'            =>  $request['organizationId'],
                'structuretype'             =>  $request['structuretype'],
                'constructionType'          =>  $request['constructionType'],
                'yearOfConstruction'        =>  $request['yearOfConstruction'],
                'plintchArea'               =>  $request['plintchArea'],
                'noOfFloor'                 =>  $request['noOfFloor'],
                'totalCapacity'             =>  $request['totalCapacity'],
                'presentCondition'          =>  $request['presentCondition'],
                'design'                    =>  $request['design'],
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];
            // dd(Infrastructure::createOrFail($infrastructure));
            // dd($infrastructure);
            $infra = eccdInfrastructure::create($infrastructure);
            $eccdinfrastructureId = $infra->id;
           foreach ($request->input('users') as  $i=> $facility){
           // dd($facility);
                $facilityInStructure = array(
                    'eccdinfrastructureId'         =>   $eccdinfrastructureId,
                    'facilityTypeId'                =>  $facility['facility'],
                    'facilityName'                  =>  $facility['facilityNo'],
                    'capacity'                      =>  $facility['capacity'],
                    'noOfFacility'                  =>  $facility['noOfFacility'],
                    'noAccessibleToDisabled'        =>  $facility['accessibleDisabled'],
                    'noWithInternetConnection'      =>  $facility['internetConnection'],
                    'created_by'                    =>  $request->user_id,
                    'created_at'                    =>  date('Y-m-d h:i:s')
                );
               // dd($facilityInStructure);
                eccdInfrastructurefacility::create($facilityInStructure);
            }
            return $this->successResponse($infra, Response::HTTP_CREATED);
        }
    }

    //ECCD Infrastructure 

    public function getStructureTypeInDropdown(){
        return ECCDStructureType::where('status',1)->get();
    }

    public function geteccdStructureFacilityInDropdown($structuretype){
        //dd('herea at microservices');
        $equi = DB::table('master_eccdFacilities_type as a')
            ->select('a.id as id', 'a.faciltytype as facilty')
            ->where('structuretype','=', $structuretype)
            ->get();
        return $equi;
    }
    
    public function loadEccdInfrastructureList($orgId=""){
        //dd($orgId);
        $list = DB::table('eccd_infrastructures as a')
            ->join('master_eccdStructure_type as b', 'b.id', '=', 'a.structuretype')
            ->join('master_construction_type as c', 'c.id', '=', 'a.constructionType')
            ->select('a.id AS id','b.name AS structuretype', 'c.name AS constructionType',
            'a.organizationId AS organizationId',
            'a.yearOfConstruction AS yearOfConstruction')
            ->where('organizationId',$orgId)->get();
        return $list;
    }

    // public function loadEccdInfrastructureList($orgId=""){
    //     $info = eccdInfrastructure::where('organizationId',$orgId)->get();
    //     return $info;
    // }
    public function getEccdInfrastructureDetails($eccdinfraId=""){
        $response_data=eccdInfrastructure::where('id',$eccdinfraId)->first();
        $response_data->facility=eccdInfrastructurefacility::where('eccdinfrastructureId',$response_data->id)->get();
        return $this->successResponse($response_data);
    }
}
