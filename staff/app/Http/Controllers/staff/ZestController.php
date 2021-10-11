<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\staff\AppointmentDetails;
use App\Models\staff\AppointmentDetailsAudit;
use App\Models\staff\PersonalDetails;
use App\Models\staff\ZestSeperation;
use Illuminate\Http\Request;

class ZestController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveAppointmentDetails(Request $request){
        $response_data=[];
        foreach($request->staffList as $app){
            $checkExist=AppointmentDetails::where('CID',$app['CID'])->where('EmpID',$app['EmpID'])->first();
            if($checkExist!=null && $checkExist!=""){
                $data =[
                    'ID'                    =>  $checkExist->ID,
                    'Year'                  =>  $checkExist->Year,
                    'ApointmentDate'        =>  $checkExist->ApointmentDate,
                    'CID'                   =>  $checkExist->CID,
                    'ContractEndDate'       =>  $checkExist->ContractEndDate,
                    'EmpID'                 =>  $checkExist->EmpID,
                    'EmployeeType'          =>  $checkExist->EmployeeType,
                    'FirstName'             =>  $checkExist->FirstName,
                    'MiddleName'            =>  $checkExist->MiddleName,
                    'LastName'              =>  $checkExist->LastName,
                    'MajorGroupID'          =>  $checkExist->MajorGroupID,
                    'MasterGroup'           =>  $checkExist->MasterGroup,
                    'Position'              =>  $checkExist->Position,
                    'PositionID'            =>  $checkExist->PositionID,
                    'PositionLevelID'       =>  $checkExist->PositionLevelID,
                    'RCSCSelected'          =>  $checkExist->RCSCSelected,
                    'FullWorkingAgency'     =>  $checkExist->FullWorkingAgency,
                    'SubGroup'              =>  $checkExist->SubGroup,
                    'SubGroupID'            =>  $checkExist->SubGroupID,
                    'SuperStructure'        =>  $checkExist->SuperStructure,
                    'SuperStructureID'      =>  $checkExist->SuperStructureID,
                    'WorkAgencyTopNode'     =>  $checkExist->WorkAgencyTopNode,
                    'WorkAgencyTopNodeID'   =>  $checkExist->WorkAgencyTopNodeID,
                    'positionLevel'         =>  $checkExist->positionLevel,
                    'subLevel'              =>  $checkExist->subLevel,
                    'created_by'            =>  $checkExist->user_id,
                    'created_at'            =>  date('Y-m-d h:i:s'),
                    'audit_by'              =>  $request->user_id,
                    'audit_at'              =>  date('Y-m-d h:i:s')
                ];
                $response_data = AppointmentDetailsAudit::create($data);
                //insert into audit
                AppointmentDetails::where('CID',$app['CID'])->where('EmpID',$app['EmpID'])->delete();
            }
            $appDate="";
            if(isset($app['ApointmentDate'])){
                $appDate=$app['ApointmentDate'];
            }

            $CID="";
            if(isset($app['CID'])){
                $CID=$app['CID'];
            }

            $ContractEndDate="";
            if(isset($app['ContractEndDate'])){
                $ContractEndDate=$app['ContractEndDate'];
            }
            $EmpID="";
            if(isset($app['EmpID'])){
                $EmpID=$app['EmpID'];
            }
            $EmployeeType="";
            if(isset($app['EmployeeType'])){
                $EmployeeType=$app['EmployeeType'];
            }
            $FirstName="";
            if(isset($app['FirstName'])){
                $FirstName=$app['FirstName'];
            }
            $MiddleName="";
            if(isset($app['MiddleName'])){
                $MiddleName=$app['MiddleName'];
            }
            $LastName="";
            if(isset($app['LastName'])){
                $LastName=$app['LastName'];
            }
            $MajorGroupID="";
            if(isset($app['MajorGroupID'])){
                $MajorGroupID=$app['MajorGroupID'];
            }
            $MasterGroup="";
            if(isset($app['MasterGroup'])){
                $MasterGroup=$app['MasterGroup'];
            }
            $Position="";
            if(isset($app['Position'])){
                $Position=$app['Position'];
            }
            $PositionID="";
            if(isset($app['PositionID'])){
                $PositionID=$app['PositionID'];
            }
            $PositionLevelID="";
            if(isset($app['PositionLevelID'])){
                $PositionLevelID=$app['PositionLevelID'];
            }
            $RCSCSelected="";
            if(isset($app['RCSCSelected'])){
                $RCSCSelected=$app['RCSCSelected'];
            }
            $FullWorkingAgency="";
            if(isset($app['FullWorkingAgency'])){
                $FullWorkingAgency=$app['FullWorkingAgency'];
            }
            $SubGroup="";
            if(isset($app['SubGroup'])){
                $SubGroup=$app['SubGroup'];
            }
            $SubGroupID="";
            if(isset($app['SubGroupID'])){
                $SubGroupID=$app['SubGroupID'];
            }
            $SuperStructure="";
            if(isset($app['SuperStructure'])){
                $SuperStructure=$app['SuperStructure'];
            }
            $SuperStructureID="";
            if(isset($app['SuperStructureID'])){
                $SuperStructureID=$app['SuperStructureID'];
            }

            $WorkAgencyTopNode="";
            if(isset($app['WorkAgencyTopNode'])){
                $WorkAgencyTopNode=$app['WorkAgencyTopNode'];
            }
            $WorkAgencyTopNodeID="";
            if(isset($app['WorkAgencyTopNodeID'])){
                $WorkAgencyTopNodeID=$app['WorkAgencyTopNodeID'];
            }
            $positionLevel="";
            if(isset($app['positionLevel'])){
                $positionLevel=$app['positionLevel'];
            }
            $subLevel="";
            if(isset($app['subLevel'])){
                $subLevel=$app['subLevel'];
            }
            $data =[
                'ApointmentDate'        =>  $appDate,
                'Year'                  =>  $request->Year,
                'CID'                   =>  $CID,
                'ContractEndDate'       =>  $ContractEndDate,
                'EmpID'                 =>  $EmpID,
                'EmployeeType'          =>  $EmployeeType,
                'FirstName'             =>  $FirstName,
                'MiddleName'            =>  $MiddleName,
                'LastName'              =>  $LastName,
                'MajorGroupID'          =>  $MajorGroupID,
                'MasterGroup'           =>  $MasterGroup,
                'Position'              =>  $Position,
                'PositionID'            =>  $PositionID,
                'PositionLevelID'       =>  $PositionLevelID,
                'RCSCSelected'          =>  $RCSCSelected,
                'FullWorkingAgency'     =>  $FullWorkingAgency,
                'SubGroup'              =>  $SubGroup,
                'SubGroupID'            =>  $SubGroupID,
                'SuperStructure'        =>  $SuperStructure,
                'SuperStructureID'      =>  $SuperStructureID,
                'WorkAgencyTopNode'     =>  $WorkAgencyTopNode,
                'WorkAgencyTopNodeID'   =>  $WorkAgencyTopNodeID,
                'positionLevel'         =>  $positionLevel,
                'subLevel'              =>  $subLevel,
                'created_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];
            $response_data = AppointmentDetails::create($data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadappointment(){
        $response_data=AppointmentDetails::get();
        return $this->successResponse($response_data);
    }
    public function loadSeperation(){
        $response_data=ZestSeperation::with('type')->get();
        if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
            foreach($response_data as $sep){
                $sep->staffName='';
                $staff=PersonalDetails::where('id',$sep['StaffID'])->first();
                if($staff!=null && $staff!=""){
                    $sep->staffName=$staff->name;
                }
            }
        }
        return $this->successResponse($response_data);
    }



}
