<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\staff\AppointmentDetails;
use App\Models\staff\AppointmentDetailsAudit;
use App\Models\staff\PersonalDetails;
use App\Models\staff\ZestLeaveDetails;
use App\Models\staff\ZestLongTermTraining;
use App\Models\staff\ZestPromotion;
use App\Models\staff\ZestSecondment;
use App\Models\staff\ZestSeperation;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\FundingAgency;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\PositionTitle;
use App\Models\staff_masters\PromotionModel;
use App\Models\staff_masters\SuperStructure;
use App\Models\staff_masters\TrainingStatus;
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

    public function loadSecondment($param=""){
        if(strpos($param,'Limit')!==false){
            $response_data=ZestSecondment::with('type')->take(explode('__',$param)[1])->get();
        }
        if(strpos($param,'byOrdId')!==false){
            $orgId=explode('__',$param)[1];
            $staffIds=[];
            $person=PersonalDetails::where('working_agency_id',$orgId)->get();
            if($person!=null && $person!="" && sizeof($person)>0){
                foreach($person as $per){
                    array_push($staffIds,$per['id']);
                }
            }
            $response_data=ZestSecondment::wherein('StaffID',$staffIds)->get();
        }
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

    public function loadPromotion($param=""){
        $response_data="";
        if($param=="All"){
            $response_data=ZestPromotion::with('type')->get();
        }
        if(strpos($param,'Limit')!==false){
            $response_data=ZestPromotion::take(explode('__',$param)[1])->get();
        }

        if(strpos($param,'byStaffId')!==false){
            $staffid=explode('__',$param)[1];
            $response_data=ZestPromotion::with('type')->where('StaffID',$staffid)->get();
        }
        if(strpos($param,'byOrdId')!==false){
            $orgId=explode('__',$param)[1];
            $staffIds=[];
            $person=PersonalDetails::where('working_agency_id',$orgId)->get();
            if($person!=null && $person!="" && sizeof($person)>0){
                foreach($person as $per){
                    array_push($staffIds,$per['zest_staff_id']);
                }
            }
            $response_data=ZestPromotion::with('type')->wherein('StaffID',$staffIds)->get();
        }
        if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
            $response_data=$this->getstaff_positiondirectory($response_data,'Array');
            foreach($response_data as $pro){
                $promotype=PromotionModel::where('ID',$pro->PromotionTypeID)->first();
                if($promotype!=null && $promotype!=""){
                    $pro->protype=$promotype->PromotionType;
                }
            }
        }
        return $this->successResponse($response_data);
    }

    public function loadPromotionDetails($id){
        $response_data=ZestPromotion::with('type')->where('ID',$id)->first();
        if($response_data!=null && $response_data!=""){
            $response_data=$this->getstaff_positiondirectory($response_data,'Single');
            $promotype=PromotionModel::where('ID',$response_data->PromotionTypeID)->first();
            if($promotype!=null && $promotype!=""){
                $response_data->protype=$promotype->PromotionType;
            }
        }
        return $this->successResponse($response_data);
    }


    private function getstaff_positiondirectory($response_data,$type){
        if($type=="Single"){
            $person=PersonalDetails::where('zest_staff_id',$response_data->StaffID)->first();
            if($person!=null && $person!=""){
                $response_data->staff_name=$person->name;
                $response_data->emp_id=$person->emp_id;
                $response_data->working_agency_id=$person->working_agency_id;
            }
            $superstructure=SuperStructure::where('id',$response_data->SuperStructureID)->first();
            if($superstructure!=null && $superstructure!=""){
                $response_data->superstructure=$superstructure->name;
            }
            $positions=ChildGroupPosition::where('id', $response_data->ChildGroupPositionID)->first();
            if($positions!=null && $positions!=""){
                //get position title from mapping
                $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                if($posi!=null && $posi!=""){
                    $response_data->position_title_name=$posi->name;
                    //get position level from position title
                    $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                    if($posiLev!=null && $posiLev!=""){
                        $response_data->positionlevel=$posiLev->name;
                    }
                }
            }
        }else{
            foreach($response_data as $res){
                $sup=SuperStructure::where('id',$res->SuperStructureID)->first();
                if($sup!=null && $sup!=""){
                    $res->superstructure=$sup->name;
                }
                $person=PersonalDetails::where('zest_staff_id',$res->StaffID)->first();
                if($person!=null && $person!=""){
                    $res->staff_name=$person->name;
                    $res->working_agency_id=$person->working_agency_id;
                    $res->position_title_name='';
                    $res->positionlevel='';
                    $positions=ChildGroupPosition::where('id', $person->position_title_id)->first();
                    if($positions!=null && $positions!=""){
                        //get position title from mapping
                        $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                        if($posi!=null && $posi!=""){
                            $res->position_title_name=$posi->name;
                            //get position level from position title
                            $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                            if($posiLev!=null && $posiLev!=""){
                                $res->positionlevel=$posiLev->name;
                            }
                        }
                    }
                }
            }
        }
        return $response_data;
    }

    public function loadLongTermTraining($param){
        $response_data="";
        if(strpos($param,'byId')!==false){
            $staffid=explode('__',$param)[1];
            $response_data=ZestLongTermTraining::where('ID',$staffid)->first();
            $response_data=$this->getstaff_positiondirectory($response_data,'Single');
            $funding=FundingAgency::where('ID',$response_data->FundingID)->first();
            if($funding!=null && $funding!=""){
                $response_data->funding=$funding->Name;
            }
            $status=TrainingStatus::where('ID',$response_data->TrainingStatusID)->first();
            if($status!=null && $status!=""){
                $response_data->training_status=$status->Status;
            }
        }else{
            if($param=="All"){
                $response_data=ZestLongTermTraining::get();
            }
            if(strpos($param,'Limit')!==false){
                $response_data=ZestLongTermTraining::take(explode('__',$param)[1])->get();
            }
            if(strpos($param,'byStaffId')!==false){
                $staffid=explode('__',$param)[1];
                $response_data=ZestLongTermTraining::where('StaffID',$staffid)->get();
            }

            if(strpos($param,'byOrdId')!==false){
                $orgId=explode('__',$param)[1];
                $staffIds=[];
                $person=PersonalDetails::where('working_agency_id',$orgId)->get();
                if($person!=null && $person!="" && sizeof($person)>0){
                    foreach($person as $per){
                        array_push($staffIds,$per['zest_staff_id']);
                    }
                }
                $response_data=ZestLongTermTraining::wherein('StaffID',$staffIds)->get();
            }
            if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
                $response_data=$this->getstaff_positiondirectory($response_data,'Array');
                foreach($response_data as $res){
                    $funding=FundingAgency::where('ID',$res->FundingID)->first();
                    if($funding!=null && $funding!=""){
                        $res->funding=$funding->Name;
                    }
                    $status=TrainingStatus::where('ID',$res->TrainingStatusID)->first();
                    if($status!=null && $status!=""){
                        $res->training_status=$status->Status;
                    }
                }
            }
        }

        return $this->successResponse($response_data);
    }

    public function loadLeaveDetails($param){
        $response_data="";
        $personal=PersonalDetails::where('id',$param)->first();
        if($personal!=null && $personal!=""){
            $response_data=ZestLeaveDetails::with('leavetype')->where('StaffID',$personal->zest_staff_id)->get();
        }
        return $this->successResponse($response_data);
    }
}
