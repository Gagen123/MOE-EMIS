<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Traits\ApiResponser;
use App\Models\Masters\Level;
use App\Models\OrganizationDetails;
use App\Models\generalInformation\SectionDetails;
use Illuminate\Support\Facades\DB;

class LoadOrganizationController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function loadOrgList($type="", $id=""){
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
        if($type=="Orgbyid" || $type=="user_login_access_id"){
            $response_data=OrganizationDetails::where('id',$id)->first();
        }
        if($type=="Headquarterbyid"){
            $response_data=HeadQuaterDetails::where('id',$id)->first();
        }
        return $this->successResponse($response_data);
    }

    public function loadClassStreamSection($type="", $id=""){
        $section = DB::select('SELECT t1.organizationId AS org_id, t1.classId AS org_class_id, t1.streamId AS org_stream_id,
        t4.id AS org_section_id, t2.class, t3.stream, t4.section FROM organization_class_streams t1 
        JOIN classes t2 ON t1.classId = t2.id LEFT JOIN streams t3 ON t1.streamId = t3.id 
        LEFT JOIN section_details t4 ON t1.id = t4.classSectionId WHERE t1.organizationId  = ?', [$id]);
        return $section;
    }
}
