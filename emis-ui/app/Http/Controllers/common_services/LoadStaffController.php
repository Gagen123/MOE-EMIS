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
            if($parent_id=="Private"){
                $param='Private__'.$this->getUserDzoId();
            }
            else{
                $param=$this->getUserDzoId();
            }
        }

        //updated by Tshewang on 2021/07/26
        if($type=="userDzoWiseCivilServent" || $type=="selectedDzoWiseCivilServent"){
            if($type=="userDzoWiseCivilServent"){ //load all civil servent by user logedin dzo id
                $param=$this->getUserDzoId();
            }else{ //load all civil servent by selected dzo id
                $param=$parent_id;
            }
            $type="dzoWiseCivilServent";
        }

        if($type=="userOrgWiseCivilServent" || $type=="selectedOrgWiseCivilServent"){
            if($parent_id=="SEN"){ //load all sen civil servent by user logedin org id
                $param='SEN__'.$this->getWrkingAgencyId();
            }else if($type=="userOrgWiseCivilServent"){ //load all civil servent by user logedin org id
                $param=$this->getWrkingAgencyId();
            }else{ //load all civil servent by selected org id
                $param=$parent_id;
            }
            $type="orgWiseCivilServent";
        }

        if($type=="userDzoWisePrivateStaff" || $type=="selectedDzoWisePrivateStaff"){
            if($type=="userDzoWisePrivateStaff"){ //load all Private servent by user logedin dzo id
                $param=$this->getUserDzoId();
            }else{ //load all private servent by selected dzo id
                $param=$parent_id;
            }
            $type="dzoWisePrivateStaff";
        }

        if($type=="userOrgWisePrivateStaff" || $type=="selectedOrgWisePrivateStaff"){
            if($type=="userOrgWisePrivateStaff"){ //load all Private servent by user logedin org id
                $param=$this->getWrkingAgencyId();
            }else{ //load all civil servent by selected org id
                $param=$parent_id;
            }
            $type="orgWisePrivateStaff";
        }

        if($type=="allCivilServent" || $type=="allPrivateStaff"){//all civil servent and private staff, by ministry user
            if($parent_id=="SEN"){ //load all sen civil servent by user logedin org id
                $param='SEN__'.$parent_id;
            }
            else{
                $param=$parent_id;
            }
        }

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
        $response_data= $this->apiService->listData('emis/common_services/StaffDetails/'.$type.'/'.$id);
        return $response_data;
    }
}
