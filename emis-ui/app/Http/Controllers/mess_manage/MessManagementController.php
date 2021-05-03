<?php

namespace App\Http\Controllers\mess_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;

class MessManagementController extends Controller
{
    //
    use ServiceHelper;
    use AuthUser; 
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveFoodRelease(Request $request){
        $rules = [
            'date'                  =>  'required',
            'dzongkhag'             =>  'required',
            'schoolName'            =>  'required',
            'quarter'               =>  'required',
        ];
        $customMessages = [
            'date.required'            => 'date is required',
            'dzongkhag.required'       => 'Dzongkhag is required',
            'schoolName.required'      => 'School Name is required',
            'quarter.required'         => 'Quarter is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $foodrelease =[
            'organizationId'           =>  $this->getWrkingAgencyId(),
            'date'                     =>  $request['date'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'schoolName'               =>  $request['schoolName'],
            'quarter'                  =>  $request['quarter'],
            'id'                       =>  $request['id'],
            'users'                    =>  $request['users'],
            'user_id'                  =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/mess_manage/foolreleasenote/saveFoodRelease', $foodrelease);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadFoodReleaseList($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
        }
        $list = $this->apiService->listData('emis/mess_manage/foolreleasenote/loadFoodReleaseList/'.$orgId);
        return $list;
    }
}
