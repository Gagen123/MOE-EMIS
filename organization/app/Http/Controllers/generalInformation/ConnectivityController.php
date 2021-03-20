<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Connectivity;
use App\Models\ContactDetails;

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
                'name'              =>$user['contactName'],
                'phone'             =>$user['phone'],
                'fax'               =>$user['fax'],
                'mobile'            =>$user['mobile'],
                'email'             =>$user['email'],
        );
             $conn = ContactDetails::create($contact_details);
        }

        return $this->successResponse($conn, Response::HTTP_CREATED);
    }
}
