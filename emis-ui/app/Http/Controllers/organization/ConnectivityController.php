<?php

namespace App\Http\Controllers\organization;
use Session;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;


class ConnectivityController extends Controller
{
    //
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function saveConnectivityDetails(Request $request){
   //     dd('from UI');
        $rules = [
           // 'connectedtoroad'            =>  'required',
            'road_typeyes'               =>  'required',
          // 'road_typeno'              =>  'required',
            'hqdistance'                    =>  'required',
            'connectedtointernet'           =>  'required',
         //   'connectiontype'             =>  'required',
         //   'serviceprovider'            =>  'required',
         //   'speedbandwidth'             =>  'required',
         //   'DrukREN'                    =>  'required',
         //   'GovNET'                     =>  'required',
         //   'independent'                 =>  'required',
            // 'sharedconnection'       =>  'required',
         //   'connectionsharedtype'       =>  'required',
          //  'sharedspeed'        =>  'required',
         //   'internetAccessible'             =>  'required',
            'electricity'                   =>  'required',
            'electricitysubstation'         =>  'required',

        ];

        $customMessages = [
            'road_typeyes.required'            => 'This is required',
            'hqdistance.required'              => 'field is required',
            'connectedtointernet.required'     => 'this is required',
            // 'sharedconnection'                 => 'This is required',
            'electricity'                      => 'This is required',
            'electricitysubstation'            => 'This is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'organizationId'                =>  $this->getWrkingAgencyId(),
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
            // 'sharedspeed'                   =>  $request['sharedspeed'],
            'internetAccessible'            =>  $request['internetAccessible'],
            'electricity'                   =>  $request['electricity'],
            'electricitysubstation'         =>  $request['electricitysubstation'],
            'electricitysource'             =>  $request['electricitysource'],           
            'id'                            =>  $request['id'],
            'user_id'                       =>  $this->userId()
        ];
      // dd($data);
       $response_data= $this->apiService->createData('emis/organization/connectivity/saveConnectivityDetails', $data);
       return $response_data;
    }
    public function loadConnectivityInformation($org_id){
        //dd('m here');
        $data = $this->apiService->listData('emis/organization/connectivity/loadConnectivityInformation/'.$org_id);
        return $data;
    }
}
