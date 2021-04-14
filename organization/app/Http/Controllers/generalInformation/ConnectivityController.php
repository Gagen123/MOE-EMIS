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
        //
    }

    public function saveConnectivity(Request $request){
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
        ];
        $conn = Connectivity::create($connectivity);

        foreach ($request->input('users') as $i=> $user){
            $contact_details = array(
                'organizationId'    =>$request['organizationId'],
                'contactTypeId'     =>$user['contactName'],
                'phone'             =>$user['phone'],
                'fax'               =>$user['fax'],
                'mobile'            =>$user['mobile'],
                'email'             =>$user['email'],
                'type'              =>2
        );
             $conn = ContactDetails::create($contact_details);
        }

        return $this->successResponse($conn, Response::HTTP_CREATED);
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
