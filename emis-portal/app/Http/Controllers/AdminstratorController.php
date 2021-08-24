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
        $person = json_decode($this->apiService->listData('getCensusData/'. $cid));
        // if ($person->citizenDetailsResponse){
        //     $response_data = $person->citizenDetailsResponse;
        //     return  $response_data;
        // }else {
        //     return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        // }
        if($person->data->hasdata){
            $response_data = $person->data->citizenDetail;
            return  response()->json($response_data);
        }else {
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
        return  response()->json($person);
    }

    /**
     * Get the details of the Student by std_id
     * Will refer to std_student table
     */

    public function getStudentDetails($std_id=""){
        $student_data=$this->apiService->listData('emis/students/admission/getStudentDetails/'.$std_id);
        return $student_data;
    }

    /**
     * Get the details of the school attended by student
     */

    public function getFullSchoolDetails($id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/getSchoolDzongkhagId/'.$id);
        return $response_data;
    }

    public function getchildDetailsOncid($cid=""){
        $personal_data=$this->apiService->listData('getchildDetailsOncid/'. $cid);
        return $personal_data;
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

    /**
     * get list of HSS based on Dzongkhag id
     */

    public function getHssSchoolList($dzo_id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/getHssSchoolList/'.$dzo_id);
        return $response_data;
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

    public function loadValidationcondition(){
        $student_masters = $this->apiService->listData('emis/masters/students/loadValidationcondition/');
        return $student_masters;
    }

    public function active_marital_list(){
        $student_masters = $this->apiService->listData('emis/staff/staffMasterController/loadStaffMasters/active/MaritalStatus');
        return $student_masters;
    }

    public function getStreamByOrgId($orgId){
        $streamsList = $this->apiService->listData('emis/organization/section/getStreamByOrgId/'.$orgId);
        return $streamsList;
    }

    // public function getseatdetailsbyOrgId($orgId){
    //     $itemList = $this->apiService->listData('emis/organization/section/getseatdetailsbyOrgId/'.$orgId);
    //     return $itemList;

    // }

}
