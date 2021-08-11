<?php

namespace App\Http\Controllers\spms;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;
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

    public function getDeoDashboardData(){
        $staff_id = $this->staffId();
        $dzon_id = $this->getUserDzoId();
        $uri ='emis/spms/getDeoDashboardData/'.$dzon_id.'/'.$staff_id;
        $spms = json_decode($this->apiService->listData($uri),true);
        $evaluated_performances = $spms['data']['evaluated_school_performances'];
        $org_ids = implode(",",array_column($spms['data']['assigned_org_ids'],'org_id'));
        $org_class_ids = implode(",",array_column($spms['data']['sub_category_class_ids'],'org_class_id'));
        $classes = json_decode($this->getOrgWiseClassesForSpms($org_ids,$org_class_ids),true);
        $category_schools = [];
        foreach($spms['data']['sub_category_class_ids'] as $category_class){
            foreach($classes as $class){
                if($category_class["org_class_id"] == $class["org_class_id"] || $category_class["org_class_id"] === null){
                    if(array_key_exists($category_class["spm_doamin_subcat_id"],$category_schools)){
                        $category_schools[$category_class["spm_doamin_subcat_id"]]["no_of_schools"]++;
                    }else{
                        $category_schools[$category_class["spm_doamin_subcat_id"]]["name"] = $category_class["name"];
                        $category_schools[$category_class["spm_doamin_subcat_id"]]["no_of_schools"] = 1;
                    }
                }
            }
        }
        foreach($category_schools as $key => $value){
            foreach($evaluated_performances as $evaluated_performance){
                if($key == $evaluated_performance['spm_domain_subcat_id']){
                    $category_schools[$key]["no_of_schools"] = $category_schools[$key]["no_of_schools"] - $evaluated_performance["no_of_schools"];
                }
            }
            if($category_schools[$key]["no_of_schools"]>0){
                array_push($evaluated_performances,["spm_domain_subcat_id"=>$key, "sub_category"=>$value["name"], "status"=>0, "status_name" => "Not Assessed", "no_of_schools"=>$category_schools[$key]["no_of_schools"]]);
            }
        }
        return $evaluated_performances;
    }
    private function getOrgWiseClassesForSpms($org_ids,$org_class_ids){
        return $this->apiService->listData('emis/common_services/getOrgWiseClassesForSpms?org_id='.$org_ids.'&org_class_id='.$org_class_ids);
    }
    public function getSchoolDoeDetails($spm_domain_subcat_id,$status=0){
        $staff_id = $this->staffId();
        $dzon_id = $this->getUserDzoId();
        $uri = "emis/spms/getSchoolDoeDetails/".$dzon_id.'/'.$staff_id.'/'.$spm_domain_subcat_id;
        if($status > 0){
            $uri .='/'.$status;
        }
        $data = json_decode($this->apiService->listData($uri),true);
        if(count($data['data']['school_performances']) > 0){
            return $data['data']['school_performances'];
        }
        
        // $org_ids = implode(",",array_column($spms['data']['assigned_org_ids'],'org_id'));
        // $org_class_ids = implode(",",array_column($spms['data']['sub_category_class_ids'],'org_class_id'));
        // $classes = json_decode($this->getOrgWiseClassesForSpms($org_ids,$org_class_ids),true);
        // return $response_data;
    }
    public function getEvaluation($org_id,$spm_domain_subcat_id){
        $response_data = $this->apiService->listData('emis/spms/getEvaluation/'.$org_id.'/'.$spm_domain_subcat_id);
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
    

}

