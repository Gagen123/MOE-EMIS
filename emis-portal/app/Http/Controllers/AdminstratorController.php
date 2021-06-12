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
        $person = json_decode($this->apiService->listData('getcensusdata/'. $cid));
        if ($person->citizenDetailsResponse){
            $response_data = $person->citizenDetailsResponse;
            return  response()->json($response_data);
        }else {
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
    }

    public function getchildDetailsOncid($cid=""){
        $personal_data=$this->apiService->listData('getchildDetailsOncid/'. $cid);
        return json_decode($personal_data)->parentDetailResponse->parentDetail;
    }


    public function loadGlobalMasters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/loadGlobalMasters/'.$param);
        return $global_masters;
    }

    public function all_active_dropdowns($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/load_dropdown/'.$model."/".$parent_id);
        return $response_data;
    }

    public function getOrgList($dzoId="",$orgType=""){
        $param="dzongkhagwise";
        if($orgType=="ECCD"){
            $param='public_eccd';
        }
        if($orgType=="School"){
            $param='school';
        }
        if($orgType=="ECR"){
            $param='ecr';
        }
        if($orgType=="CE"){
            $param='ce';
        }
        return $this->apiService->getListData('emis/common_services/loadOrgList/'.$param.'/'.$dzoId);
    }

    public function loadClassStreamSection($type = "", $orgId = ''){
        $itemList = $this->apiService->listData('emis/common_services/loadClassStreamSection/'.$type.'/'.$orgId);
        return $itemList;
    }


    public function loadOrganizationDetailsbyOrgId($id){
        $loadOrganizationDetails = $this->apiService->listData('emis/common_services/loadOrgDetails/fullOrgDetbyid/'.$id );
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

    // public function getseatdetailsbyOrgId($orgId){
    //     $itemList = $this->apiService->listData('emis/organization/section/getseatdetailsbyOrgId/'.$orgId);
    //     return $itemList;

    // }




}
