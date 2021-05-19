<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\CeaProgramInventory;
use App\Models\Students\CeaProgramInventoryDetail;
use App\Models\Students\CeaProgramInventoryExpenditure;
use App\Models\Students\CeaProgramInventoryProduction;
use App\Models\Students\CeaProgramActionPlan;
use App\Models\Students\CeaProgramActionPlanDetail;
use App\Models\Students\CeaSchoolProgramme;
use App\Models\Students\CeaProgrammeMembership;
use App\Models\Students\CeaRoleStaff;
use App\Models\Students\CeaRoleStudent;


class StudentProgramController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentProgram(Request $request){
        $rules = [
            'program'            => 'required',
            'supporter'            => 'required',
            'year'            => 'required'
        ];

        $customMessages = [
            'program.required'  => 'This field is required',
            'supporter.required'     => 'This field is required',
            'year.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                        => $request->id,
            'OrgOrganizationId'         => $request->organisation_id,
            'CeaProgrammeId'            => $request->program,
            'CeaProgrammeSupporterId'   => $request->supporter,
            'EstablishmentYear'         => $request->year,
            'Remarks'                   => $request->remarks,
            'assigned_staff'            => $request->assigned_staff
        ];

        $assigned_staff_details = $data['assigned_staff'];

        unset($data['assigned_staff']);

        $response = CeaSchoolProgramme::create($data);
        $lastInsertId = $response->id;

        

        foreach($assigned_staff_details as $key => $value){
            $assigned_staff_data['CeaSchoolProgrammeId'] = $lastInsertId;
            $assigned_staff_data['CeaRoleId'] = $value['role'];
            $assigned_staff_data['StfStaffId'] = $value['teacher'];
            $assigned_staff_data['Remarks'] = $value['remarks'];

            $response_data = CeaRoleStaff::create($assigned_staff_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Function is to load the list of student Programs
    */

    public function loadStudentPrograms($param=""){

        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_supporter', 'cea_school_programme.CeaProgrammeSupporterId', '=', 'cea_programme_supporter.id')
                ->select('cea_school_programme.*', 'cea_programme.name AS program_name', 'cea_programme_supporter.name AS supporter_name' )
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $id ="1";

        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_school_programme.id', 'cea_programme.name AS name')
                ->get();

        return $this->successResponse($records);
    }

    /**
     * Get the Program Details given a program id
     */

    public function getProgramDetails($param=""){
        $id = $param;

        $response_data=CeaSchoolProgramme::where('id',$id)->first();
        $response_data->roles=CeaRoleStaff::where('CeaSchoolProgrammeId',$id)->get();
        return $this->successResponse($response_data); 
    }

    /*
    * Save Program Members
    */

    public function saveProgramMembers(Request $request){

        $rules = [
            'student'            => 'required',
            'program'            => 'required',
            'responsibilities'            => 'required',
        ];

        $customMessages = [
            'student.required'  => 'This field is required',
            'program.required'     => 'This field is required',
            'responsibilities.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request->id,
            'StdStudentId'               => $request->student,
            'CeaSchoolProgrammeId'               => $request->program,
            'Responsibility'      => $request->responsibilities,
            'JoiningDate'           => $request->date,
            'role'                  => $request->role

            //'user_id'        => $this->user_id() 
        ];
        
        $assigned_student_details = $data['role'];

        unset($data['role']);

        $response = CeaProgrammeMembership::create($data);
        $lastInsertId = $response->id;

        foreach($assigned_student_details as $key => $value){
            $assigned_std_data['CeaSchoolProgrammeId'] = $data['CeaSchoolProgrammeId'];
            $assigned_std_data['CeaRoleId'] = $value;
            $assigned_std_data['StdStudentId'] = $data['StdStudentId'];

            $response_data = CeaRoleStudent::create($assigned_std_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /*
    * Function is to list Program Members
    */

    public function listProgramMembers($param=""){
        $id ="1";

        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_membership', 'cea_school_programme.id', '=', 'cea_programme_membership.CeaSchoolProgrammeId')
                ->join('std_student', 'cea_programme_membership.StdStudentId', '=', 'std_student.id')
                ->select('cea_programme_membership.*', 'std_student.Name AS student_name', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Save Program Inventory
    */

    public function saveProgramInventory(Request $request){

        $rules = [
            'program'            => 'required',
            'month'            => 'required',
        ];

        $customMessages = [
            'program.required'     => 'This field is required',
            'month.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request->id,
            'OrgOrganizationId'     => $request->organisation_id,
            'CeaProgrammeId'        => '17b2b454-6f86-49c1-b763-8f02202d3071',
            // 'CeaProgrammeId'        => $request->program,
            'ForMonth'              => $request->month,
            'Remarks'               => $request->remarks,
            'inventoryDetails'      => $request->inventoryDetails,
            'productionDetails'     => $request->productionDetails,
            'expenditureDetails'    => $request->expenditureDetails,

            //'user_id'        => $this->user_id() 
        ];

        $inventory_details = $data['inventoryDetails'];
        $production_details = $data['productionDetails'];
        $expenditure_details = $data['expenditureDetails'];

        unset($data['inventoryDetails']);
        unset($data['productionDetails']);
        unset($data['expenditureDetails']);

        $response = CeaProgramInventory::create($data);
        $lastInsertId = $response->id;

        foreach($inventory_details as $key => $value){
            $inventory_data['CeaProgrammeInventoryId'] = $lastInsertId;
            $inventory_data['CeaProgrammeInventoryItemId'] = 1;
            // $inventory_data['CeaProgrammeInventoryItemId'] = $value['item_id'];
            $inventory_data['IncreaseInQuantity'] = $value['increase_quantity'];
            $inventory_data['DecreaseInQuantity'] = $value['decrease_quantity'];
            $inventory_data['Remarks'] = $value['remarks'];
            
            $inventory_response = CeaProgramInventoryDetail::create($inventory_data);
        }

        foreach($production_details as $key => $value){
            $production_data['CeaProgrammeInventoryId'] = $lastInsertId;
            $production_data['CeaProgrammeInventoryItemId'] = 1;
            // $production_data['CeaProgrammeInventoryItemId'] = $value['item_produced'];
            $production_data['QuantityProduced'] = $value['quantity_produced'];
            $production_data['NoOfVariety'] = $value['no_varieties'];
            $production_data['AmountGenerated'] = $value['amount_generated'];
            $production_data['Remarks'] = $value['production_remarks'];
            
            $production_response = CeaProgramInventoryProduction::create($production_data);
        }

        foreach($expenditure_details as $key => $value){
            $expenditure_data['CeaProgrammeInventoryId'] = $lastInsertId;
            $expenditure_data['Particular'] = $value['expenditure_details'];
            $expenditure_data['Amount'] = $value['expenditure_amount'];
            $expenditure_data['Remarks'] = $value['expenditure_remarks'];
            
            $expenditure_response = CeaProgramInventoryExpenditure::create($expenditure_data);
        }

        return $this->successResponse($expenditure_response, Response::HTTP_CREATED);
    }

    /*
    * Function is to load inventory of the programs
    */

    public function loadProgramInventory($param=""){

        $id ="1";

        $records = DB::table('cea_programme')
                ->join('cea_programme_inventory', 'cea_programme_inventory.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_inventory_detail', 'cea_programme_inventory.id', '=', 'cea_programme_inventory_detail.CeaProgrammeInventoryId')
                ->select('cea_programme_inventory.ForMonth', 'cea_programme_inventory_detail.*', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Save Program Action Plan
    */

    public function saveProgramActionPlan(Request $request){

        $rules = [
            'program'            => 'required',
            'from_date'            => 'required',
            'to_date'           => 'required'
        ];

        $customMessages = [
            'program.required'     => 'This field is required',
            'from_date.required'  => 'This field is required',
            'to_date.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request->id,
            'OrgOrganizationId'       => 1,
            'CeaProgrammeId'               => $request->program,
            'FromDate'             => $request->from_date,
            'ToDate'               => $request->to_date,
            'action_plan'           => $request->action_plan

            //'user_id'        => $this->user_id() 
        ];

        $action_plan_details = $data['action_plan'];

        unset($data['action_plan']);

        $response = CeaProgramActionPlan::create($data);
        $lastInsertId = $response->id;

        foreach($action_plan_details as $key => $value){
            $action_plan_data['CeaProgrammeActionPlanId'] = $lastInsertId;
            $action_plan_data['Title'] = $value['title'];
            $action_plan_data['Description'] = $value['description'];
            
            $plan_response = CeaProgramActionPlanDetail::create($action_plan_data);
        }

        return $this->successResponse($plan_response, Response::HTTP_CREATED);
    }

    /*
    * Function is to load the student Programs Action Plan
    */

    public function loadProgramActionPlan($param=""){
        
        $id ="1";

        $records = DB::table('cea_programme')
                ->join('cea_programme_action_plan', 'cea_programme_action_plan.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_action_plan_detail', 'cea_programme_action_plan.id', '=', 'cea_programme_action_plan_detail.CeaProgrammeActionPlanId')
                ->select('cea_programme_action_plan.*', 'cea_programme_action_plan_detail.*', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);

    }
}
