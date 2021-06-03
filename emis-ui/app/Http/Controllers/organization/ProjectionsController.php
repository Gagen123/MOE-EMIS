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
            'std_class'          =>  'required',
            'projections'          =>  'required',
            'remarks'          =>  'required',
        ];
        $customMessages = [
            'std_class.required'         => 'Class is required',
            'projections.required'         => 'Projections is required',
            'remarks.required'         => 'Remarks is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'std_class'                      =>  $request['std_class'],
            'projections'                      =>  $request['projections'],
            'remarks'                      =>  $request['remarks'],
            'user_id'                   =>  $this->userId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/organization/projections/saveProjections', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadProjections(){

        $orgId=$this->getWrkingAgencyId();
        $dis = $this->apiService->listData('emis/organization/projections/loadProjections/'.$orgId);
        return $dis;
    }

}
