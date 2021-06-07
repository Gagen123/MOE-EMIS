<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Models\generalInformation\VariousConnectivity;

class VariousConnectivityController extends Controller
{
    //
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
  public function saveConnectivityDetails(Request $request){
    // dd('m at microservices');
    $data =[
      'organizationId'           =>  $request['organizationId'],
      'connectedtoroad'                  =>  $request['connectedtoroad'],
      'road_typeyes'              =>  $request['road_typeyes'],
      'road_typeno'                  =>  $request['road_typeno'],
      'hqdistance'                  =>  $request['hqdistance'],
      'connectedtointernet'                  =>  $request['connectedtointernet'],
      'connectiontype'                  =>  $request['connectiontype'],
      'serviceprovider'                  =>  $request['serviceprovider'],
      'speedbandwidth'                  =>  $request['speedbandwidth'],
      'DrukREN'                  =>  $request['DrukREN'],
      'GovNET'                  =>  $request['GovNET'],
      'independent'                  =>  $request['independent'],
      'sharedconnection'                  =>  $request['sharedconnection'],
      'connectionsharedtype'                  =>  $request['connectionsharedtype'],
      'sharedspeed'                  =>  $request['sharedspeed'],
      'internetAccessible'                  =>  $request['internetAccessible'],
      'electricity'                  =>  $request['electricity'],
      'electricitysubstation'                  =>  $request['electricitysubstation'],
      'created_by'                  =>  $request['user_id'],
      'created_at'                  =>  date('Y-m-d h:i:s'),

    ];
    VariousConnectivity::where('organizationId',$request['organizationId'])->update($data);
        
    return $this->successResponse($response_data, Response::HTTP_CREATED);
  }

    
  public function loadConnectivityInformation($orgId=""){
  //  dd('from microservices');
    $info = VariousConnectivity::where('organizationId',$orgId)->first();
    return $info;
  }
}
