<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;
use App\Models\generalInformation\Disaster;

class DisasterController extends Controller
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

    public function saveDisasterInformation(Request $request){
       // dd('microservices');
        $data =[
            'organizationId'            =>  $request['organizationId'],
            'disasterTypeId'            =>  $request['diastertype'],
            'diastercomm'               =>  $request['diastercomm'],
            'cid'                       =>  $request['cid_passport'],
            'name'                      =>  $request['fullname'],
            'sex_id'                    =>  $request['sex_id'],
            'email'                     =>  $request['email'],
            'contactNo'                 =>  $request['contactno'],
            'servingAs'                 =>  $request['servining_as'],
            'placeOfWork'               =>  $request['fulladdress'],

        ];
      //  dd( $data );
        $response_data = Disaster::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    
    public function loadDisasterInformation($orgId=""){
        $info = Disaster::where('organizationId',$orgId)->get();
        return $info;
    }
}
