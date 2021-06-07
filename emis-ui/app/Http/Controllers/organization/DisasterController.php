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
      //  dd($request);
        $rules = [
            'disastertype'          =>  'required',
            'disastercomm'           =>  'required',
            'cid_passport'          =>  'required',
            'fullname'              =>  'required',
            'sex_id'                =>  'required',
            'email'                 =>  'required',
            'contactno'             =>  'required',
          //  'servining_as'          =>  'required',
            'fulladdress'           => 'required',
        ];
        $customMessages = [
            'disastertype.required'         => 'Disastertertype is required',
            'disastercomm.required'          => 'Disaster Committee is required',
            'cid_passport.required'         => 'CID is required',
            'fullname.required'             => 'Name is required',
            'sex_id.required'               => 'Gender is required',
            'email.required'                => 'Email is required',
            'contactno.required'            => 'Contact is required',
         //   'servining_as.required'         => 'Address is required',
            'fulladdress.required'          => 'Address is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'                =>  $this->getWrkingAgencyId(),
            'disastertype'                  =>  $request['disastertype'],
            'disastercomm'                   =>  $request['disastercomm'],
            'cid_passport'                  =>  $request['cid_passport'],
            'fullname'                      =>  $request['fullname'],
            'sex_id'                        =>  $request['sex_id'],
            'email'                         =>  $request['email'],
            'contactno'                     =>  $request['contactno'],
            'servining_as'                  =>  $request['servining_as'],
            'fulladdress'                   =>  $request['fulladdress'],
            'actiontype'                    =>  $request['actiontype'],
            'id'                            =>  $request['id'],
            'user_id'                       =>  $this->userId()
        ];
      //  dd($loc);
        try{
            $response_data= $this->apiService->createData('emis/organization/disaster/saveDisasterInformation', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadDisasterInformation(){
      //  dd('loading');
        $orgId=$this->getWrkingAgencyId();
        $dis = $this->apiService->listData('emis/organization/disaster/loadDisasterInformation/'.$orgId);
        return $dis;
    }

}
