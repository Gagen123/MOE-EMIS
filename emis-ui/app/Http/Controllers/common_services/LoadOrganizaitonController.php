<?php

namespace App\Http\Controllers\common_services;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Http\Controllers\Controller;
class LoadOrganizaitonController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function loadOrgList($type="",$id=""){//'id','name','levelId','dzongkhagId'
        //if Ministry then give entire list
        $access_level = $this->getAccessLevel();
        if($access_level == 'Ministry' && $type!="dzongkhagwise" && $type!="gewoggwise"){
            $type = "allorganizationList";
        }

        $param="";
        //type=allorganizationList: to list entire organization
        if($type=="allorganizationList"){
            $param=$id;
        }

        //type=userdzongkhagwise: to list with dzongkhag id from user login
        if($type=="userdzongkhagwise"){
            $param=$this->getUserDzoId();
        }

        //type=userworkingagency: to list with working agency from user login
        if($type=="userworkingagency"){
            $param=$this->getWrkingAgencyId();
        }

        //type=dzongkhagwise, parent_id=?: to list with dzongkhag id
        if($type=="dzongkhagwise"){
            $param=$id;
        }

        //type=gewoggwise, parent_id=?: to list with gewog id
        if($type=="gewoggwise"){
            $param=$id;
        }
        
        // dd('emis/common_services/loadOrgList/'.$type.'/'.$param);
        return $this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/'.$param);
    }

    public function loadInactiveOrgList(){
        $dzo_id = $this->getUserDzoId();
        return $this->apiService->getListData('emis/common_services/loadInactiveOrgList/'.$dzo_id);
    }

    //type can be Orgbyid,Headquarterbyid,user_login_access_id, orgcode etc and id shoulb be their respective values
    public function loadOrgDetails($type="",$id=""){
        
        if($type=="full_user_logedin_dzo_id"){
            $id=$this->getUserDzoId();
        }
        return $this->apiService->getListData('emis/common_services/loadOrgDetails/'.$type.'/'.$id);
    }

    public function loadHeaquarterList($type="",$parent_id=""){
        $param="";
        //type=allList: to list entire headquarters
        if($type=="allList"){
            $param="NA";
        }

        //list headquarters of all dzongkhg
        if($type=="all_dzongkhag_headquarters"){
            $param=2;
        }

        //list headquarters of all ministry
        if($type=="all_ministry_headquarters"){
            $param=1;
        }
        return $this->apiService->getListData('emis/common_services/loadHeaquarterList/'.$type.'/'.$param);
    }

    /**
     * type values "NOT AVAILABLE" and "ANY"
     *
     */

    public function loadClassStreamSection($type="",$id=""){
        //type=userworkingagency: to list with working agency from user login
        if($type=="userworkingagency"){
            $id=$this->getWrkingAgencyId();
        }

        //type=selelctedorgWise: by selected organization
        if($type=="selelctedorgWise"){
            $id=$id;
        }
        return $this->apiService->getListData('emis/common_services/loadClassStreamSection/'.$type.'/'.$id);
    }
    public function getClassByType($type=""){
        return $this->apiService->getListData('emis/common_services/getClassByType/'.$type);
    }

    /**
     * Get the class list from the organization class mapping
     */

    public function getOrgClassStream(){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/getOrgClassStream/'.$org_id);
    }

    /**
     * function to get the class stream section by organization
     * params is Class, Stream and Section separated by __ (double underscore)
     */

    public function getClassStreamSection($params){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/getClassStreamSection/'.$params.'/'.$org_id);
    }

    /**
     * the id is the id from the table organizaiton_class_streams
     */

    public function loadStreamList($id){
        return $this->apiService->getListData('emis/common_services/loadStreamList/'.$id);
    }

    public function loadSectionList($id){
        return $this->apiService->getListData('emis/common_services/loadSectionList/'.$id);
    }

    /**
     * the get Arrays fetches the list of classes, streams and sections in an array
     * this is for display the name of the class, stream and section
     */

    public function getClassArray(){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/getClassArray/'.$org_id);
    }

    public function getStreamArray(){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/getStreamArray/'.$org_id);
    }

    public function getSectionArray(){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/getSectionArray/'.$org_id);
    }

}
