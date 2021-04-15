<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Connectivity;
use App\Models\ContactDetails;
use App\Models\Masters\RoadType;
use App\Models\Masters\ElectricitySource;
use App\Models\Masters\ElectricitySupply;
use App\Models\Masters\ServiceProvider;
use App\Models\Masters\ContactType;

use Illuminate\Support\Facades\DB;

class ConnectivityController extends Controller
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

    public function saveConnectivity(Request $request){
        $id = $request->id;

        if($id != null){
            $connectivity = [
                'roadTypeId'                         =>  $request['approachRoad'],
                'organizationId'                     =>  $request['organizationId'],
                'electricitySourceId'                =>  $request['electricitySource'],
                'telephoneServiceProvoderId'         =>  $request['telephone'],
                'internetServiceProviderId'          =>  $request['internet'],
                'distanceFromRoad'                   =>  $request['distanceFromRoad'],
                'daysFromRoad'                       =>  $request['daysFromRoad'],
                'hoursFromRoad'                      =>  $request['hoursFromRoad'],
                'electricitySupplyId'                =>  $request['electricitySupply'],
                'hasElectricalSubstation'            =>  $request['electricalSubstation'],
                'mbps'                               =>  $request['bandwidth'],
                'drukRenConnection'                  =>  $request['drukRen'],
                'updated_by'                         =>  $request->user_id,
                'created_at'                         =>  date('Y-m-d h:i:s')
            ];

            $conn = Connectivity::where('id', $id)->update($connectivity);
            
            DB::table('contact_details')->where('organizationId', $request->organizationId)->delete();

            foreach ($request->input('users') as $i=> $user){
                $contact_details = array(
                    'organizationId'    =>  $request['organizationId'],
                    'contactTypeId'     =>  $user['contactName'],
                    'phone'             =>  $user['phone'],
                    'mobile'            =>  $user['mobile'],
                    'email'             =>  $user['email'],
                    'type'              =>  2,
                    'updated_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
            );
                 $conn = ContactDetails::create($contact_details);
            }
            return $this->successResponse($conn, Response::HTTP_CREATED);

        }else{
            $connectivity = [
                'roadTypeId'                         =>  $request['approachRoad'],
                'organizationId'                     =>  $request['organizationId'],
                'electricitySourceId'                =>  $request['electricitySource'],
                'telephoneServiceProvoderId'         =>  $request['telephone'],
                'internetServiceProviderId'          =>  $request['internet'],
                'distanceFromRoad'                   =>  $request['distanceFromRoad'],
                'daysFromRoad'                       =>  $request['daysFromRoad'],
                'hoursFromRoad'                      =>  $request['hoursFromRoad'],
                'electricitySupplyId'                =>  $request['electricitySupply'],
                'hasElectricalSubstation'            =>  $request['electricalSubstation'],
                'mbps'                               =>  $request['bandwidth'],
                'drukRenConnection'                  =>  $request['drukRen'],
                'created_by'                         =>  $request->user_id,
                'created_at'                         =>  date('Y-m-d h:i:s')
            ];
            $conn = Connectivity::create($connectivity);
    
            foreach ($request->input('users') as $i=> $user){
                $contact_details = array(
                    'organizationId'    =>  $request['organizationId'],
                    'contactTypeId'     =>  $user['contactName'],
                    'phone'             =>  $user['phone'],
                    'mobile'            =>  $user['mobile'],
                    'email'             =>  $user['email'],
                    'type'              =>  2,
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
            );
                 $conn = ContactDetails::create($contact_details);
            }
    
            return $this->successResponse($conn, Response::HTTP_CREATED);
        }
    }

    /**
     * method to get road type use in dropdown
     */
    public function getRoadTypeDropdown(){
        return RoadType::get(['id','name']);
    }

    /**
     * method to get electricity source use in dropdown
     */
    public function getElectricitySourceDropdown(){
        return ElectricitySource::get(['id','name']);
    }

    /**
     * method to get electricity supply use in dropdown
     */
    public function getElectricitySupplyDropdown(){
        return ElectricitySupply::get(['id','name']);
    }

    /**
     * method to get service provider use in dropdown
     */
    public function getServiceProviderDropdown(){
        return ServiceProvider::where ('serviceType',1)->get();
    }

    /**
     * method to get service provider use in dropdown
     */
    public function getServiceProviderDropdown1(){
        return ServiceProvider::where ('serviceType',2)->get();
    }

    /**
     * method to get contact type  in dropdown
     */
    public function getContactTypeDropdown(){
        return ContactType::get(['id','name']);
    }

    
}
