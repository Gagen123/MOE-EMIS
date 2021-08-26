<?php

namespace App\Http\Controllers\spms;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class SpmsController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function schoolPerformaceDashboard($year){
        $can_add_edit_performance = false;
        $dzoWiseNoOfSchools = json_decode($this->apiService->listData('emis/common_services/getDzoWiseNoOfSchools'),true);
        if($this->getAccessLevel() =='Org'){
            return [];
        }
        if($this->getAccessLevel() =='Dzongkhag'){
            $dzon_id = $this->getUserDzoId();
            $dzongkhags = [['dzon_id' => $dzon_id]];
            $can_add_edit_performance = true;
        }else {
            $emo_id = $this->staffId();
            $dzongkhags = json_decode($this->apiService->listData('emis/spms/getDzoEMO/'.$emo_id),true)['data'];
        }

        if(count($dzongkhags) > 0){
            $dzongkhag_ids = implode(",",array_column($dzongkhags,'dzon_id'));
        }else{
            $dzongkhag_ids = "ALL";
        }
        $schoolPerformaces = json_decode($this->apiService->listData('emis/spms/schoolPerformaceDashboard?dzongkhag_ids='.$dzongkhag_ids.'&year='.$year),true)['data'];
        $all_dzongkhags = json_decode($this->apiService->listData('emis/masters/loadGlobalMasters/all_active_dzongkhag'),true)['data'];
        $performances = [];
        if(count($dzongkhags) > 0){
            foreach($dzongkhags as $key => $dzongkhag){
                if($schoolPerformaces && count($schoolPerformaces)>0){
                    foreach($schoolPerformaces as $schoolPerformace){
                        if($schoolPerformace['dzon_id'] == $dzongkhag['dzon_id']){
                            $dzongkhags[$key]["under_process"] = $schoolPerformace['under_process'];
                            $dzongkhags[$key]["completed"] = $schoolPerformace['completed'];
                            $dzongkhags[$key]["year"] = $schoolPerformace['year'];
                        }
                    }
                }else{
                    $dzongkhags[$key]["under_process"] = 0;
                    $dzongkhags[$key]["completed"] = 0;
                    $dzongkhags[$key]["year"] = $year;
                }
                foreach($all_dzongkhags as $dzong){
                    if($dzongkhag['dzon_id'] == $dzong['id']){
                        $dzongkhags[$key]["dzongkhag"] = $dzong['name'];
                    }
                }
                foreach($dzoWiseNoOfSchools as $dzoWiseNoOfSchool){
                    if($dzongkhag['dzon_id'] == $dzoWiseNoOfSchool['dzongkhagId']){
                        $dzongkhags[$key]["not_assessed"] = $dzoWiseNoOfSchool['no_of_schools'] - ($dzongkhags[$key]['under_process'] + $dzongkhags[$key]['completed']);
                    }
                }
            }
            $performances = $dzongkhags;
        }else{
            foreach($all_dzongkhags as $key => $dzongkhag){
                if($schoolPerformaces && count($schoolPerformaces)>0){
                    foreach($schoolPerformaces as $schoolPerformace){
                        if($schoolPerformace['dzon_id'] == $dzongkhag['id']){
                            $all_dzongkhags[$key]["under_process"] = $schoolPerformace['under_process'];
                            $all_dzongkhags[$key]["completed"] = $schoolPerformace['completed'];
                        }
                    }
                }else{
                    $all_dzongkhags[$key]["under_process"] = 0;
                    $all_dzongkhags[$key]["completed"] = 0;
                }
                foreach($dzoWiseNoOfSchools as $dzoWiseNoOfSchool){
                    if($dzongkhag['id'] == $dzoWiseNoOfSchool['dzongkhagId']){
                        $all_dzongkhags[$key]["not_assessed"] = $dzoWiseNoOfSchool['no_of_schools'] - ($all_dzongkhags[$key]['under_process'] + $all_dzongkhags[$key]['completed']);
                    }
                }
            }
            $performances = $all_dzongkhags;
        }
        return ['performances'=>$performances,'can_add_edit_performance'=>$can_add_edit_performance];
    }
    public function getSchoolPerformaceList($year,$dzon_id,$status){
        $type="school";
        $schools = json_decode($this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/'.$dzon_id),true)["data"];

       //$assessedSchools: Status 0 -> all assessed schools under the Dz; Status 1/2 - schools with assessment  status 1/2
       $assessedSchools = json_decode($this->apiService->listData('emis/spms/getSchoolPerformaceList/'.$year.'/'.$dzon_id.'/'.$status),true)['data'];
        $filteredData = [];
        foreach($schools as $school){
            $assessed = false;
            $evaluationId = '';
            if(count($assessedSchools) > 0){
                foreach($assessedSchools as $assessedSchool){
                    if($school['id'] == $assessedSchool['org_id']){
                        $assessed = true;
                        $evaluationId = $assessedSchool['id'];
                    }
                }
            }
            if($status == 0 && !$assessed){
                array_push($filteredData,['evaluation_id'=>$evaluationId,'school_id'=>$school['id'],'school'=>$school['name'],'dzon_id'=> $school['dzongkhagId']]);
            }elseif($status != 0 && $assessed){
                array_push($filteredData,['evaluation_id'=>$evaluationId,'school_id'=>$school['id'],'school'=>$school['name'],'dzon_id'=> $school['dzongkhagId']]);
            }
        }
        return $filteredData;
    }
    public function getEvaluation($org_id,$year){
        $response_data = $this->apiService->listData('emis/spms/getEvaluation/'.$org_id.'/'.$year);
        return $response_data;
    }
    public function saveEvaluation(Request $request){
        $rules = [
            'data.*.spm_indicator_id' => 'required',
            'data.*.score' => 'required',
        ];
        $customMessages = [
            'data.*.spm_indicator_id.required' => 'This field is required',
            'data.*.score.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/spms/saveEvaluation',$data);
        return $response_data;
    }
    public function getSchoolDashboardData(){
        $org_id = $this->getWrkingAgencyId();
        $response_data = $this->apiService->listData('emis/spms/getSchoolDashboardData/'.$org_id);
        return $response_data;
    }
    public function saveSchoolPlan(Request $request){
        $rules = [
            'spm_domain_id' => 'required',
            'activity' => 'required',
            'objective' => 'required',
            'strategy' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after:start_date',
            'person_responsible' => 'required',
            'implementation_status_id' => 'required',
            'remarks' => 'required',
        ];
        $customMessages = [
            'spm_domain_id.required' => 'This field is required',
            'activity.required' => 'This field is required',
            'objective.required' => 'This field is required',
            'strategy.required' => 'This field is required',
            'start_date.required' => 'This field is required',
            'end_date.required' => 'This field is required',
            'person_responsible.required' => 'This field is required',
            'implementation_status_id.required' => 'This field is required',
            'remarks.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['dzon_id'] = $this->getUserDzoId();
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/spms/saveSchoolPlan',$data);
        return $response_data;
    }
    public function getSchoolPlan($school_id){
        $response_data =$this->apiService->listData('emis/spms/getSchoolPlan/'.$school_id);
        return $response_data;
    }
   
    public function saveImplementtationStatus(Request $request){
        $rules = [
            'comment' => 'required',
            'implementation_status_id' => 'required',
            'full_name' => 'required',
            'organization' => 'required',
            'roles' => 'required',
            'spm_school_plan_id' => 'required',
        ];
        $customMessages = [
            'comment.required' => 'This field is required',
            'implementation_status_id.required' => 'This field is required',
            'full_name.required' => 'This field is required',
            'organization.required' => 'This field is required',
            'roles.required' => 'This field is required',
            'spm_school_plan_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/spms/saveImplementtationStatus',$data);
        return $response_data;
    }
    public function getSchoolPlanDetails($spm_school_plan_id){
        $response_data = $this->apiService->listData('emis/spms/getSchoolPlanDetails/'.$spm_school_plan_id);
        return $response_data;
    }
    public function getSchoolPlanHistory($spm_school_plan_id){
        $response_data = $this->apiService->listData('emis/spms/getSchoolPlanHistory/'.$spm_school_plan_id);
        return $response_data;
    }
    public function loadOrgList(){
        $type="school";
         if($this->getAccessLevel() =='Dzongkhag'){
            $dzon_id = $this->getUserDzoId();
            $schools = json_decode($this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/'.$dzon_id),true)["data"];
            $dzongkhags = [['dzon_id' => $dzon_id]];
        }else {
            $emo_id = $this->staffId();
            $dzongkhags = json_decode($this->apiService->listData('emis/spms/getDzoEMO/'.$emo_id),true)['data'];
            $schools = [];
            if(count($dzongkhags) > 0){
                foreach($dzongkhags as $dzongkhag){
                    $schoolsUnderDzo= json_decode($this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/'.$dzongkhag['dzon_id']),true);
                    $schools = array_merge($schools,$schoolsUnderDzo['data']);
                }
            }else {
                $schools = json_decode($this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/NA'),true)['data'];
            }
        }

        $dzongkhag_ids = implode(",",array_column($dzongkhags,'dzon_id'));
        $schoolPlans = json_decode($this->apiService->listData('emis/spms/getSchoolPlans?dzongkhag_ids='.$dzongkhag_ids),true);
        $all_dzongkhags = json_decode($this->apiService->listData('emis/masters/loadGlobalMasters/all_active_dzongkhag'),true)['data'];
        $filteredData = [];
        foreach($schools as $school){
            $hasPlan = 0;
            foreach($schoolPlans as $schoolPlan){
                if($school['id'] == $schoolPlan['org_id']){
                    $hasPlan = 1;
                }
            }
            foreach($all_dzongkhags as $dzong){
                if($school['dzongkhagId'] == $dzong['id']){
                    $dzongkhag = $dzong['name'];
                }
            }
            array_push($filteredData,['school_id'=>$school['id'],'school'=>$school['name'],'dzo_id'=>$school['dzongkhagId'],'dzongkhag'=>$dzongkhag,'hasPlan'=>$hasPlan]);
        }
        return $filteredData;
    }
    public function saveAgencyInputForm(Request $request){
        $rules = [
            'name' => 'required',
            'org_division_id' => 'required',
            'year' => 'required',
            'input' => 'required',
            'activity' => 'required',
            'output' => 'required',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
            'org_division_id.required' => 'This field is required',
            'year.required' => 'This field is required',
            'input.required' => 'This field is required',
            'activity.required' => 'This field is required',
            'output.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/spms/saveAgencyInputForm',$data);
        return $response_data;
    }
    public function getAgencyInputForm(){
        $orgId = $this->getWrkingAgencyId();
        $global_masters = $this->apiService->listData('emis/spms/getAgencyInputForm/'.$orgId);
        return $global_masters;
    }
    public function getAgencyInputFormDetail($agencyInputFormId){
        $orgId = $this->getWrkingAgencyId();
        $global_masters = $this->apiService->listData('emis/spms/getAgencyInputFormDetail/'.$agencyInputFormId.'/'.$orgId);
        return $global_masters;
    }
    public function saveObservationAgencyInputForm(Request $request){
        $rules = [
            'dzon_id' => 'required',
            'school_id' => 'required',
            'agency_input_id' => 'required',
            'observation' => 'required',
            'recommendation' => 'required',
            'recommendation_date' => 'required'
        ];
        $customMessages = [
            'dzon_id.required' => 'This field is required',
            'school_id.required' => 'This field is required',
            'agency_input_id.required' => 'This field is required',
            'observation.required' => 'This field is required',
            'recommendation.required' => 'This field is required',
            'recommendation_date.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/spms/saveObservationAgencyInputForm',$data);
        return $response_data;
    }
    public function saveActionAgencyInputForm(Request $request){
        $rules = [
            'agency_input_id' => 'required',
            'agency_input_obs_id' => 'required',
            'action' => 'required',
            'action_date' => 'required',
        ];
        $customMessages = [
            'agency_input_id.required' => 'This field is required',
            'agency_input_obs_id.required' => 'This field is required',
            'action.required' => 'This field is required',
            'action_date.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/spms/saveActionAgencyInputForm',$data);
        return $response_data;
    }
    public function saveAcknowlegeAgencyInputForm(Request $request){
        $rules = [
            'agency_input_id' => 'required',
            'school_id' => 'required',
            'acknowledgement' => 'required',
        ];
        $customMessages = [
            'agency_input_id.required' => 'This field is required',
            'school_id.required' => 'This field is required',
            'acknowledgement.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/spms/saveAcknowlegeAgencyInputForm',$data);
        return $response_data;
    }

}

