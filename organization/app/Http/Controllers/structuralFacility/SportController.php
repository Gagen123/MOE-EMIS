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
        //
    }

    /**
     * method to load sport lists
     */
    public function loadSport(){
        $loadSport = DB::table('sports as a')
            ->join('sport_facility_type as b', 'a.facility', '=', 'b.id')
            ->select('a.id as id', 'a.organizationId as organizationId', 'b.name as facilityName',
             'a.type as type', 'a.yearOfEstablishment as yearOfEstablishment','a.status as status',
             'a.noOfFacility as noOfFacility','a.accessibleToDisabled as accessibleToDisabled',
            'a.facility as facility', 'a.supportedBy as supportedBy')->get();
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
            ];
            $spo = Sport::where('id', $id)->update($sport);
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
            ];
            $spo = Sport::create($sport);
        }
        return $this->successResponse($spo, Response::HTTP_CREATED);
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
}
