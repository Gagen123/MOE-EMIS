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

class ProjectionsController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveProjections(Request $request){
        $rules = [
            
        ];
        $customMessages = [
            
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'academicYear'              =>  $request['academicYear'],
            'items_received'            =>  $request->items_received,
            'user_id'                   =>  $this->userId()
        ];

        $response_data= $this->apiService->createData('emis/organization/projections/saveProjections', $loc);
        return $response_data;
    }

    public function loadProjections(){
        $orgId=$this->getWrkingAgencyId();
        //dd( $orgId);
        $dis = $this->apiService->listData('emis/organization/projections/loadProjections/'.$orgId);
        return $dis;
    }

}
