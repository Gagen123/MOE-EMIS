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
        $loadSport = DB::table('organization_sports as a')
            ->join('master_sport_facility_type as b', 'a.facility', '=', 'b.id')
            ->join('master_sport_facility_subtypes as c', 'c.id', '=', 'a.type')
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
       // dd($sportId);
        $response_data=Sport::where('id',$sportId)->get();
        return $this->successResponse($response_data);
    }

    /**
     * method to save sport details
     */
    public function saveSport(Request $request){
        //dd($request);
        $id = $request->id;
        $organizationId  = $request['organizationId'];
        $facility = $request['facility'];
        $noOffacilities = $request['no_of_facility'];
        if( $id != null){
            DB::table('organization_sports')->where('id', $request->id)->delete();
            foreach($request->items_received as $i=> $item){
                $size="";
                if(isset($item['area'])){
                    $size=$item['area'];
                }
                $sport = [
                    'id'                                    =>  $id,
                    'organizationId'                        =>  $organizationId,
                    'facility'                              =>  $facility,
                    'number'                                =>  $noOffacilities,
                    'type'                                  =>  $item['type'],
                    'yearOfEstablishment'                   =>  $item['yoe'],
                    'status'                                =>  $item['status'],
                    'size'                                  =>  $size,
                    'sportstype'                            =>  $item['sportstype'],
                    'supportedBy'                           =>  $item['support'],
                    'accessibleToDisabled'                  =>  $item['access'],
                    'updated_by'                            =>  $request->user_id,
                    'created_at'                            =>  date('Y-m-d h:i:s')
                ];
               // dd( $sport);
                $spo = Sport::create($sport);
            }
            return $this->successResponse($spo, Response::HTTP_CREATED);
        }
        else{
            $organizationId  = $request['organizationId'];
            $facility = $request['facility'];
            $noOffacilities = $request['no_of_facility'];
            foreach ($request->items_received as $i=> $item){
                $size="";
                if(isset($item['area'])){
                    $size=$item['area'];
                }
                //  dd($item);
                $sport = array(
                    'id'                               =>  $id,
                    'organizationId'                   =>  $organizationId,
                    'facility'                         =>  $facility,
                    'type'                             =>  $item['type'],
                    'number'                           =>  $noOffacilities,
                    'yearOfEstablishment'              =>  $item['yoe'],
                    'accessibleToDisabled'             =>  $item['access'],
                    'size'                             =>  $size,
                    'status'                           =>  $item['status'],
                    'sportstype'                       =>  $item['sportstype'],
                    'supportedBy'                      =>  $item['support'],
                    'updated_by'                       =>  $request->user_id,
                    'created_at'                       =>  date('Y-m-d h:i:s')
                );
                // dd( $sport);
                $sportdata = Sport::create($sport);
            }
            return $this->successResponse($sportdata, Response::HTTP_CREATED);
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
        $equi = DB::table('master_sport_facility_subtypes as a')
            ->select('a.id as id', 'a.name as typeName')
            //->where('sportFacilityId','=',$id)
            ->get();
        return $equi;
    }
}
