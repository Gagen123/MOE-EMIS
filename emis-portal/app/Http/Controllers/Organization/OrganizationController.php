<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helper\EmisService;
use App\Traits\AuthUser;

class OrganizationController extends Controller
{
    public $apiService;
    use AuthUser;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function loadSchoolList($dzoId="",$type=""){
        $response_data= $this->apiService->getListData('emis/common_services/loadOrgList/admission_dzongkhagwise__'.$type.'/'.$dzoId);
        return $response_data;
    }

    public function loadParentSchoolList($orgId){
        $response_data= $this->apiService->getListData('emis/common_services/loadParentSchoolList/'.$orgId);
        return $response_data;
    }

    public function loadProjection($classId=""){
        $response_data= $this->apiService->getListData('emis/common_services/loadProjection/'.$classId);
        return $response_data;
    }

    public function loadOrganizationDetailsbyOrgId($id){
        $loadOrganizationDetails = $this->apiService->listData('emis/common_services/loadOrgDetails/fullOrgDetbyid/'.$id );
        return $loadOrganizationDetails;
    }

    public function loadStreamList(){
        $response_data = $this->apiService->listData('emis/masters/stream/loadStream');
        return $response_data;
    }
    
}
