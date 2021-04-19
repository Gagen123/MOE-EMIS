<?php

namespace App\Http\Controllers\structuralFacility;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\structuralFacility\Sport;
use App\Models\Masters\SportFacilityType;
use App\Models\Masters\SportSupporter;
use Illuminate\Support\Facades\DB;

class SportController extends Controller
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
     * method to load sport lists
     */
    public function loadSport($orgId=""){
        $loadSport = DB::table('sports as a')
            ->join('sport_facility_type as b', 'a.facility', '=', 'b.id')
            ->join('sport_facility_subtypes as c', 'b.id', '=', 'c.sportFacilityId')
            ->select('a.id as id', 'a.organizationId as organizationId', 'b.name as facilityName',
             'a.type as typeId','c.name as type', 'a.yearOfEstablishment as yearOfEstablishment','a.status as status',
             'a.noOfFacility as noOfFacility','a.accessibleToDisabled as accessibleToDisabled',
            'a.facility as facility', 'a.supportedBy as supportedBy')
            ->where('organizationId',$orgId)->get();
        return $loadSport;
    }

    /**
     * method to save sport details
     */
    public function saveSport(Request $request){
        $id = $request->id;
        if( $id != null){
            $sport = [
                'organizationId'                        =>  $request['organizationId'],
                'facility'                              =>  $request['facility'],
                'type'                                  =>  $request['type'],
                'yearOfEstablishment'                   =>  $request['yearOfEstablish'],
                'status'                                =>  $request['status'],
                'supportedBy'                           =>  $request['supportedBy'],
                'noOfFacility'                          =>  $request['numberOfFacility'], 
                'accessibleToDisabled'                  =>  $request['facilityAccessibleToDisabled'],
                'updated_by'                            =>  $request->user_id,
                'created_at'                            =>  date('Y-m-d h:i:s')
            ];
            $spo = Sport::where('id', $id)->update($sport);
            return $this->successResponse($spo, Response::HTTP_CREATED);
        }else{
            $sport = [
                'organizationId'                        =>  $request['organizationId'],
                'facility'                              =>  $request['facility'],
                'type'                                  =>  $request['type'],
                'yearOfEstablishment'                   =>  $request['yearOfEstablish'],
                'status'                                =>  $request['status'],
                'supportedBy'                           =>  $request['supportedBy'],
                'noOfFacility'                          =>  $request['numberOfFacility'], 
                'accessibleToDisabled'                  =>  $request['facilityAccessibleToDisabled'],
                'created_by'                            =>  $request->user_id,
                'created_at'                            =>  date('Y-m-d h:i:s')
            ];
            $spo = Sport::create($sport);
            return $this->successResponse($spo, Response::HTTP_CREATED);
        }
        
    }
    
    /**
     * method to load facility in dropdown
     */
    public function getFacilityInDropdown(){
        return SportFacilityType::get(['id','name']);
    }

    /**
     * method ot get support in dropdown
     */
    public function getSupportInDropdown(){
        return SportSupporter::get(['id','name']);
    }

    /**
     * method to get sport subtype in dropdown by category
     */
    public function getSubFacilityDropdown($id){
        $equi = DB::table('sport_facility_subtypes as a')
            ->select('a.id as id', 'a.name as typeName')
            ->where('sportFacilityId','=',$id)
            ->get();
        return $equi;
    }
}
