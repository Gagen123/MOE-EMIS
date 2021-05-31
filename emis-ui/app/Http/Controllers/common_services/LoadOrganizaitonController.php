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
        return $this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/'.$param);
    }
    //type can be Orgbyid,Headquarterbyid,user_login_access_id, orgcode etc and id shoulb be their respective values
    public function loadOrgDetails($type="",$id=""){
        if($type=="full_user_logedin_dzo_id"){
            $id=$this->getUserDzoId();
        }
        return $this->apiService->getListData('emis/common_services/loadOrgDetails/'.$type.'/'.$id);
    }

    public function loadHeaquarterList($type="",$id=""){
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
     * function to get the class stream section by organization
     * params is Class, Stream and Section separated by __ (double underscore)
     */

    public function getClassStreamSection($params){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/getClassStreamSection/'.$params.'/'.$org_id);
    }

    public function loadClassList(){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/getClassStreamSection/'.$org_id);
    }

    public function loadStreamList(){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/loadStreamList/'.$org_id);
    } 

    public function loadSectionList(){
        $org_id = $this->getWrkingAgencyId();
        return $this->apiService->getListData('emis/common_services/loadSectionList/'.$org_id);
    }    

}
