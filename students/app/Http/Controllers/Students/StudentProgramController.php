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

class StudentProgramController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

<<<<<<< HEAD
    
=======
    public function saveStudentProgram(Request $request){
        $rules = [
            'program'            => 'required',
            'supporter'            => 'required',
            'year'            => 'required',
            'roles'            => 'required',
        ];

        $customMessages = [
            'program.required'  => 'This field is required',
            'supporter.required'     => 'This field is required',
            'year.required'  => 'This field is required',
            'roles.required'     => 'Assign a role',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                => $request->id,
            'program'           => $request->program,
            'supporter'         => $request->supporter,
            'year'              => $request->year,
            'remarks'           => $request->remarks,
            'assigned_staff'    => $request->assigned_staff,
            'assigned_student'  => $request->assigned_student,

            //'user_id'        => $this->user_id() 
        ];

        $response_data = CeaProgram::create($data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $id ="1";

        $records = DB::table('cea_project')
                ->join('cea_project_type', 'cea_project.CeaProjectTypeId', '=', 'cea_project_type.id')
                ->join('cea_programme', 'cea_project.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_project.*', 'cea_project_type.name AS project_type', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Save Program Members
    */

    public function saveProgramMembers(Request $request){

        $rules = [
            'student'            => 'required',
            'project'            => 'required',
            'task'            => 'required',
        ];

        $customMessages = [
            'student.required'  => 'This field is required',
            'project.required'     => 'This field is required',
            'task.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'StdStudentId'          => $request->student,
            'CeaProjectId'             => $request->project,
            'Task'             => $request->task

            //'user_id'        => $this->user_id() 
        ];

        $response_data = CeaProgramMembership::create($data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);

        
    }

    /*
    * Function is to list Programs members
    */

    public function listProgramMembers($param=""){
        $id ="1";

        $records = DB::table('cea_project_membership')
                ->join('std_student', 'cea_project_membership.StdStudentId', '=', 'std_student.id')
                ->join('cea_project', 'cea_project_membership.CeaProjectId', '=', 'cea_project.id')
                ->join('cea_programme', 'cea_project.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_project_membership.*', 'cea_project.name AS project_name', 'std_student.Name AS student_name', 'cea_programme.name AS program_name')
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
>>>>>>> 0a87f1aa0b78dfed59ff1496f6c4ec4b14dd33aa
}
