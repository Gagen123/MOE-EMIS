<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Traits\ApiResponser;
use App\Models\Masters\Level;
class LoadOrganizationController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function loadStaffList($type="", $id=""){
        $response_data="";
        if($type=="userworkingagency"){
            $response_data=OrganizationDetails::where('id',$id)->get();
        }
        if($type=="gewoggwise"){
            $response_data=OrganizationDetails::where('gewogId',$id)->get();
        }
        if($type=="dzongkhagwise"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->get();
        }
        if($type=="allorganizationList"){
            $response_data=OrganizationDetails::all();
        }
        return $this->successResponse($response_data);
    }
    public function getOrgDetailsById($type="", $id=""){
        $response_data="";
        if($type=="Orgbyid"){
            $response_data=OrganizationDetails::where('id',$id)->first();
        }
        if($type=="Headquarterbyid"){
            $response_data=HeadQuaterDetails::where('id',$id)->first();
        }
        return $this->successResponse($response_data);
    }
    pub
}
