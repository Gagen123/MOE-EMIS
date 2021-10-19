<?php

namespace App\Http\Controllers\organization;

use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;

class ProjectionsController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveProjections(Request $request){
        $rules = [
            
        ];
        $customMessages = [
            
        ];
        $this->validate($request, $rules, $customMessages);

        if($request->id != ""){
            //use of class Id instead of class value
            $loc =[
                'id'                        =>  $request->id,
                'organizationId'            =>  $this->getWrkingAgencyId(),
                'academicYear'              =>  $request['academicYear'],
                'class_projections'         =>  $request->class_projections,
                'class'                     =>  $request->classId,
                'user_id'                   =>  $this->userId()
            ];
        } else {
            $loc =[
                'id'                        =>  $request->id,
                'organizationId'            =>  $this->getWrkingAgencyId(),
                'academicYear'              =>  $request['academicYear'],
                'class_projections'         =>  $request->class_projections,
                'user_id'                   =>  $this->userId()
            ];
        }

        $response_data= $this->apiService->createData('emis/organization/projections/saveProjections', $loc);
        return $response_data;
    }

    public function loadProjections(){
        $orgId=$this->getWrkingAgencyId();
        //dd( $orgId);
        $dis = $this->apiService->listData('emis/organization/projections/loadProjections/'.$orgId);
        return $dis;
    }


    public function saveFeeders(Request $request){
        $rules = [
            'parent_school'     =>  'required',
            'class'             => 'required'
        ];

        $customMessages = [
            'parent_school.required'    => 'Please select Parent School',
            'class.required'            => 'Please select class'
        ];

        $this->validate($request, $rules, $customMessages);
        $loc =[
            'id'                        => $request->id,
            'feederschool'              => $request->feeder_school,
            'class'                     => $request->class,
            'parent_school'            =>  $request->parent_school,
            'user_id'                   =>  $this->userId(),
            'orgId'                     =>  $this->getWrkingAgencyId(),
        ];

        $response_data= $this->apiService->createData('emis/organization/feeder/saveFeeders', $loc);
        return $response_data;
    }

    public function loadFeeders(){
        $dzoId=$this->getUserDzoId();
        //dd( $orgId);
        $dis = $this->apiService->listData('emis/organization/feeder/loadFeeders/'.$dzoId);
        return $dis;
    }

    public function saveFeederStudents(Request $request){
        $data = $request->all();
        $additional_data = [
            'user_id'       =>  $this->userId(),
            'present_org'   =>  $this->getWrkingAgencyId()
        ];
        $data = $data + $additional_data;

        $response_data= $this->apiService->createData('emis/organization/feeder/saveFeederStudents', $data);
        return $response_data;
    }

    public function editFeederStudents(Request $request){
        $data = $request->all();

        $response_data= $this->apiService->createData('emis/organization/feeder/editFeederStudents', $data);
        return $response_data;
    }

    public function listParentSchool(){
        $org_id = $this->getWrkingAgencyId();

        $list = $this->apiService->listData('emis/organization/feeder/listParentSchool/'.$org_id);
        return $list;
    }

    public function loadFeederStudents(){
        $org_id = $this->getWrkingAgencyId();

        $list = $this->apiService->listData('emis/organization/feeder/loadFeederStudents/'.$org_id);
        return $list;
    }
}
