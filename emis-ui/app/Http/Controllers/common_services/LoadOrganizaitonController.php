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
    public function loadOrgList($type="",$id=""){
        $param="";
        //type=allstaff: to listentire staff
        if($type=="allorganizationList"){
            $param="NA";
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

        return $this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/'.$id);
    }
    //type can be Orgbyid,Headquarterbyid,user_login_access_id, orgcode etc and id shoulb be their respective values
    public function loadOrgDetails($type="",$id=""){
        return $this->apiService->getListData('emis/common_services/loadOrgDetails/'.$type.'/'.$id);
    }

}
