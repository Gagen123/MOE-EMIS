<?php

namespace App\Http\Controllers\structuralFacility;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\structuralFacility\Sport;
use App\Models\Eccd;
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
            ->join('sport_facility_subtypes as c', 'c.id', '=', 'a.type')
            ->select('a.id as id', 'a.organizationId as organizationId', 'b.name as facility',
            'c.name as type', 'a.yearOfEstablishment as yearOfEstablishment',
            'a.status as status','a.number as number','a.accessibleToDisabled as accessibleToDisabled',
            'a.supportedBy as supportedBy')
            ->where('organizationId',$orgId)->get();
        return $loadSport;
    }
    public function loadeccd($orgId=""){
        $loadSport = DB::table('eccds as a')
            ->join('sport_facility_type as b', 'a.facility', '=', 'b.id')
            ->join('sport_facility_subtypes as c', 'b.id', '=', 'c.sportFacilityId')
            ->select('a.id as id', 'a.organizationId as organizationId', 'b.name as facilityName',
             'a.type as typeId','c.name as type', 'a.yearOfEstablishment as yearOfEstablishment','a.status as status',
             'a.noOfFacility as noOfFacility','a.accessibleToDisabled as accessibleToDisabled',
            'a.facility as facility', 'a.supportedBy as supportedBy')
            ->where('organizationId',$orgId)->get();
        return $loadSport;
    }

    public function getSportsDetails($sportId=""){
        //dd($sportId);
        $response_data=Sport::where('id',$sportId)->first();
        return $this->successResponse($response_data);
    }

    /**
     * method to save sport details
     */
    public function saveSport(Request $request){
      //  dd($request);
        $id = $request->id;
        if( $id != null){
            $sport = [
                'id'                                    =>  $request['id'],
                'organizationId'                        =>  $request['organizationId'],
                'facility'                              =>  $request['facility'],
                'number'                                =>  $request['number'],
                'type'                                  =>  $request['type'],
                'yearOfEstablishment'                   =>  $request['yoe'],
                'status'                                =>  $request['status'],
                'size'                                  =>  $request['area'],
                'sportstype'                            =>  $request['sportstype'],
                'supportedBy'                           =>  $request['support'],
                'accessibleToDisabled'                  =>  $request['access'],
                'updated_by'                            =>  $request->user_id,
                'created_at'                            =>  date('Y-m-d h:i:s')
            ];
            $spo = Sport::where('id', $id)->update($sport);
            return $this->successResponse($spo, Response::HTTP_CREATED);

            }else{
                $organizationId  = $request['organizationId'];
                $facility = $request['facility'];

                foreach ($request->items_received as $i=> $item){
                    $sport = array(
                     'organizationId'                   =>  $organizationId,
                     'facility'                         =>  $facility,
                     'type'                             =>  $item['type'],
                     'number'                           =>  $item['number'],
                     'yearOfEstablishment'              =>  $item['yoe'],
                     'accessibleToDisabled'             =>  $item['access'],
                     'size'                             =>  $request['area'],
                     'status'                           =>  $item['status'],
                     'sportstype'                       =>  $item['sportstype'],
                     'supportedBy'                      =>  $item['support'],
                     'updated_by'                       =>  $request->user_id,
                     'created_at'                       =>  date('Y-m-d h:i:s')
                    );
                   // dd($sport);
                  // dd( $facility);
                // try{
                 $localpro = Sport::create($sport);
                // }
                // catch(\Illuminate\Database\QueryException $ex){
                //     dd($ex);

                // }
            }
            return $this->successResponse($localpro, Response::HTTP_CREATED);
        }
    }
    public function saveEccd(Request $request){
        $id = $request->id;
        if( $id != null){
            $sport = [
                'organizationId'                        =>  $request['organizationId'],
                'facility'                              =>  $request['facility'],
                'yearOfEstablishment'                   =>  $request['yearOfEstablish'],
                'status'                                =>  $request['status'],
                'supportedBy'                           =>  $request['supportedBy'],
                'noOfFacility'                          =>  $request['numberOfFacility'], 
                'updated_by'                            =>  $request->user_id,
                'created_at'                            =>  date('Y-m-d h:i:s')
            ];
            
            $spo = Eccd::where('id', $id)->update($sport);
            return $this->successResponse($spo, Response::HTTP_CREATED);

            }else{
                $sport = [
                    'organizationId'                        =>  $request['organizationId'],
                    'facility'                              =>  $request['facility'],
                    'yearOfEstablishment'                   =>  $request['yearOfEstablish'],
                    'status'                                =>  $request['status'],
                    'supportedBy'                           =>  $request['supportedBy'],
                    'noOfFacility'                          =>  $request['numberOfFacility'], 
                    'created_by'                            =>  $request->user_id,
                    'created_at'                            =>  date('Y-m-d h:i:s')
                ];
                $spo = Eccd::create($sport);
                return $this->successResponse($spo, Response::HTTP_CREATED);
            }
        
    }
    
    /**
     * method to load facility in dropdown
     */
    public function getFacilityInDropdown(){
        return SportFacilityType::where('status',1)->get();
    }

    /**
     * method ot get support in dropdown
     */
    public function getSupportInDropdown(){
        return SportSupporter::where('status',1)->get();
    }

    /**
     * method to get sport subtype in dropdown by category
     * the sportFacilityId commented for Demo (June)
     * Check and fix
     */
    public function getSubFacilityDropdown($id){
        $equi = DB::table('sport_facility_subtypes as a')
            ->select('a.id as id', 'a.name as typeName')
            //->where('sportFacilityId','=',$id)
            ->get();
        return $equi;
    }
}
