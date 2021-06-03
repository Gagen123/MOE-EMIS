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
        $data =[
            'organizationId'            =>  $request['organizationId'],
            'name'                      =>  $request['name'],
            'cid'                      =>  $request['cid'],
            'email'                  =>  $request['email'],
            'contactNo'             =>  $request['contact_no'],
            'servingAs'             => $request['serving_as'],
            'placeOfWork'                    =>  $request['address']
        ];

        $response_data = Disaster::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    
    public function loadDisasterInformation($orgId=""){
        $info = Disaster::where('organizationId',$orgId)->get();
        return $info;
    }
}
