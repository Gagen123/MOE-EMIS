<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Models\generalInformation\VariousConnectivity;
use App\Models\generalInformation\ConnectivityModel;

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
    $requestdata =[
      'organizationId'                =>  $request['organizationId'],
      'connectedtoroad'               =>  $request['connectedtoroad'],
      'road_typeyes'                  =>  $request['road_typeyes'],
      'road_typeno'                   =>  $request['road_typeno'],
      'hqdistance'                    =>  $request['hqdistance'],
      'connectedtointernet'           =>  $request['connectedtointernet'],
      'connectiontype'                =>  $request['connectiontype'],
      'serviceprovider'               =>  $request['serviceprovider'],
      'speedbandwidth'                =>  $request['speedbandwidth'],
      'DrukREN'                       =>  $request['DrukREN'],
      'GovNET'                        =>  $request['GovNET'],
      'independent'                   =>  $request['independent'],
      'sharedconnection'              =>  $request['sharedconnection'],
      'connectionsharedtype'          =>  $request['connectionsharedtype'],
      // 'sharedspeed'                =>  $request['sharedspeed'],
      'internetAccessible'            =>  $request['internetAccessible'],
      'electricity'                   =>  $request['electricity'],
      'electricitysubstation'         =>  $request['electricitysubstation'],
      'electricitysource'             =>  $request['electricitysource'],    
      'created_by'                    =>  $request['user_id'],
      'created_at'                    =>  date('Y-m-d h:i:s'),

    ];
    // dd($requestdata);
    // dd($data,$request['organizationId']);
    try{ 
        $data=ConnectivityModel::where('organizationId',$request->organizationId)->first();
       
        if($data!=""){
          $response_data=ConnectivityModel::where('organizationId',$request->organizationId)->update($requestdata);
        }
        else{
          $response_data=ConnectivityModel::create($requestdata);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    catch(GuzzleHttp\Exception\ClientException $e){
        return $e;
    }
   
  }

    
  public function loadConnectivityInformation($org_id=""){
   // dd('from microservices');
    $info = VariousConnectivity::where('organizationId',$org_id)->first();
    return $info;
  }
}
