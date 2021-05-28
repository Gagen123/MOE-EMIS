<?php

namespace App\Http\Controllers;

use App\Helper\EmisService;
use Illuminate\Http\Request;
use App\Traits\ServiceHelper;

class AdminstratorController extends Controller
{
    public $apiService;
    use ServiceHelper;

    public function __construct(EmisService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getpersonbycid($cid){
        // dd($cid);
        $person = json_decode($this->apiService->listData('/getcensusdata'. $cid));
        if ($person->citizenDetailsResponse) {
            $response_data = $person->citizenDetailsResponse;
            return  response()->json($response_data);
        }else {
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
    }


    public function loadGlobalMasters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/loadGlobalMasters/'.$param);
        return $global_masters;
    }

    public function all_active_dropdowns($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/load_dropdown/'.$model."/".$parent_id);
        return $response_data;
    }

    public function getOrgList($dzoId=""){
        $param="dzongkhagwise";
        return $this->apiService->getListData('emis/common_services/loadOrgList/'.$param.'/'.$dzoId);
    }

    public function getClassByOrganizationId($orgId = ""){
        $itemList = $this->apiService->listData('emis/organization/section/getClassByOrganizationId/'.$orgId);
        return $itemList;
    }


    public function loadOrganizationDetailsbyOrgId($id){        
        $loadOrganizationDetails = $this->apiService->listData('emis/organization/establishment/loadOrganizationDetailsbyOrgId/'.$id );
        return $loadOrganizationDetails;
    }

    public function load_gewog_details_by_id($id=""){
        $response_data= $this->apiService->listData('emis/masters/load_gewog_details_by_id/'.$id);
         return $response_data;
    }
    public function load_dzongkhag_details_by_id($id=""){
        $response_data= $this->apiService->listData('emis/masters/load_dzongkhag_details_by_id/'.$id);
         return $response_data;
    }

    public function getseatdetailsbyOrgId($orgId){
        $itemList = $this->apiService->listData('emis/organization/section/getseatdetailsbyOrgId/'.$orgId);
        return $itemList;

    }

    

    
}
