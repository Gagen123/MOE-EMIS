<?php

namespace App\Http\Controllers\common_services;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class LoadStaffController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    //parameter type: type of staff you want to extrace
    //parameter parent_id: if you have parent id at user interface, then send it along with type
    public function loadStaffList($type="",$parent_id=""){
        $param=$parent_id;
        //type=allstaff: to listentire staff
        if($type=="allstaff"){
            $param='NA';
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
            $param=$parent_id;
        }

        //type=orgwise, parent_id=?: to list with dzongkhag id
        if($type=="orgwise"){
            $param=$parent_id;
        }
        //type=orgwise, parent_id=?: to list with dzongkhag id
        if($type=="orgwise"){
            $param=$parent_id;
        }
        // dd($type.'/'.$param);
        $response_data= $this->apiService->listData('emis/common_services/loadStaffList/'.$type.'/'.$param);
        return $response_data;
    }

    //load staff details: id,name,gender and position title
    public function loadFewDetailsStaffList($type="",$parent_id=""){
        $param="";
        //type=allstaff: to listentire staff
        if($type=="allstaff"){
            $param='NA';
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
            $param=$parent_id;
        }

        //type=orgwise, parent_id=?: to list with dzongkhag id
        if($type=="orgwise"){
            $param=$parent_id;
        }
        $response_data= $this->apiService->listData('emis/common_services/loadFewDetailsStaffList/'.$type.'/'.$param);
        return $response_data;
    }


    //type can be id, cid, empid and id shoulb be their respective values
    public function viewStaffDetails($type="",$id=""){
        $response_data= $this->apiService->listData('emis/common_services/viewStaffDetails/'.$type.'/'.$id);
        return $response_data;
    }
}
