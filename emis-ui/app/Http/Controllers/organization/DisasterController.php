<?php

namespace App\Http\Controllers\organization;

use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;

class DisasterController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveDisasterInformation(Request $request){
        $rules = [
            'name'          =>  'required',
            'cid'          =>  'required',
            'email'      =>  'required',
            'contact_no'        =>  'required',
            'address'       => 'required'
        ];
        $customMessages = [
            'name.required'         => 'Name is required',
            'cid.required'         => 'CID is required',
            'email.required'     => 'email is required',
            'contact_no.required'       => 'Number is required',
            'address.required'       => 'Address is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'name'                      =>  $request['name'],
            'cid'                      =>  $request['cid'],
            'email'                  =>  $request['email'],
            'contact_no'                    =>  $request['contact_no'],
            'serving_as'             => $request['serving_as'],
            'address'                    =>  $request['address'],
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/organization/disaster/saveDisasterInformation', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadDisasterInformation(){
        $orgId=$this->getWrkingAgencyId();
        $dis = $this->apiService->listData('emis/organization/disaster/loadDisasterInformation/'.$orgId);
        return $dis;
    }

}
