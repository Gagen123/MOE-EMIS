<<<<<<< HEAD
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
use App\Models\Students\CeaClubMembership;
use App\Models\Students\CeaRoleStaff;
use App\Models\Students\CeaRoleStudent;
use App\Models\Masters\CeaProgramType;
use App\Models\Masters\StudentClub;



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
            // 'assigned_staff'            => $request->assigned_staff
        ];

        if($request->record_type == 'add'){
            $response_data = CeaSchoolProgramme::create($data);
        } else {
            $school_data = CeaSchoolProgramme::where('id',$request->id)->first();
            $data =$data+[
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>   date('Y-m-d h:i:s'),
            ];
            CeaSchoolProgramme::where('id',$school_data->id)->update($data);
            $response_data = CeaSchoolProgramme::first();
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Function is to load the list of student Programs
    */

    public function loadStudentPrograms($param=""){
        $org_id = $param;
        $program_type = CeaProgramType::where('Name', 'like', 'Program%')->select('id')->first();
        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_supporter', 'cea_school_programme.CeaProgrammeSupporterId', '=', 'cea_programme_supporter.id')
                ->select('cea_school_programme.*', 'cea_programme.name AS program_name', 'cea_programme_supporter.name AS supporter_name' )
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $program_type = CeaProgramType::where('Name', 'like', 'Program%')->select('id')->first();
        $org_id = $param;

        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_school_programme.id', 'cea_programme.name AS name', 'cea_programme.id AS programme_id')
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Function is to load the list of student clubs
    */

    public function loadStudentClubs($param=""){
        $program_type = CeaProgramType::where('Name', 'like', 'Club%')->select('id')->first();
        $org_id = $param;
        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_supporter', 'cea_school_programme.CeaProgrammeSupporterId', '=', 'cea_programme_supporter.id')
                ->select('cea_school_programme.*', 'cea_programme.name AS program_name', 'cea_programme_supporter.name AS supporter_name' )
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentClubs($param=""){
        $org_id = $param;
        $program_type = CeaProgramType::where('Name', 'like', 'Club%')->select('id')->first();

        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_school_programme.id', 'cea_programme.name AS name', 'cea_programme.id AS programme_id')
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /**
     * Get the Program Details given a program id
     */

    public function getProgramDetails($param=""){
        $id = $param;

        $response_data=CeaSchoolProgramme::where('id',$id)->first();
        //$response_data->roles=CeaRoleStaff::where('CeaSchoolProgrammeId',$id)->get();
        return $this->successResponse($response_data); 
    }

    /*
    * Save Program Members
    */

    public function saveProgramMembers(Request $request){
        $id = $request->id;
        if( $id != null && $id!= null){
        $rules = [
            'student'                    => 'required',
            'program'                    => 'required',
            'responsibilities'           => 'required',
        ];

        $customMessages = [
            'student.required'           => 'This field is required',
            'program.required'           => 'This field is required',
            'responsibilities.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                    => $request->id,
            'CeaProgrammeId'        => $request->program,
            'StdStudentId'          => $request->student,
            'JoiningDate'           => $request->date,
            'Responsibility'        => $request->responsibilities,
            'Status'                => $request->status
        ];
        try{
            $response_data=CeaProgrammeMembership::where('id', $id)->update($data);

            } catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
                // Note any method of class PDOException can be called on $ex.
            }
        // $response_data = CeaProgrammeMembership::where('id', $id)->update($data);
    }
      else {
        $rules = [
            'student'                    => 'required',
            'program'                    => 'required',
            'responsibilities'           => 'required',
        ];

        $customMessages = [
            'student.required'           => 'This field is required',
            'program.required'           => 'This field is required',
            'responsibilities.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                    => $request->id,
            'CeaProgrammeId'        => $request->program,
            'StdStudentId'          => $request->student,
            'JoiningDate'           => $request->date,
            'Responsibility'        => $request->responsibilities,
            'Status'                => $request->status
        ];
        $response_data = CeaProgrammeMembership::create($data);
      }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

        //Fix once the roles have been decided
        
        // $assigned_student_details = $data['role'];
        
        // unset($data['role']);
        // $response = CeaProgrammeMembership::create($data);
        // $lastInsertId = $response->id;

        // foreach($assigned_student_details as $key => $value){
        //     $assigned_std_data['CeaSchoolProgrammeId'] = $data['CeaSchoolProgrammeId'];
        //     $assigned_std_data['CeaRoleId'] = $value;
        //     $assigned_std_data['StdStudentId'] = $data['StdStudentId'];

        //     $response_data = CeaRoleStudent::create($assigned_std_data);
        // }
        
    }

    /*
    * Function is to list Program Members
    */

    public function listProgramMembers($param=""){
        $org_id = $param;

        $response_data = DB::table('cea_programme_membership')
                            ->join('cea_programme', 'cea_programme_membership.CeaProgrammeId', '=', 'cea_programme.id')
                            ->join('std_student', 'cea_programme_membership.StdStudentId', '=', 'std_student.id')
                            ->select('cea_programme_membership.*', 'cea_programme.name AS program_name',
                                'std_student.Name AS student_name', 'std_student.student_code AS student_code')
                            ->where('std_student.OrgOrganizationId', $org_id)
                            ->get();

        return $this->successResponse($response_data);

    }

    /*
    * Save Program Members
    */

    public function saveClubMembers(Request $request){
        $id = $request->id;
        if( $id != null && $id!= null){
        $rules = [
              'student'                    => 'required',
              'club'                       => 'required',
              'responsibilities'           => 'required',
          ];
  
          $customMessages = [
              'student.required'           => 'This field is required',
              'club.required'               => 'This field is required',
              'responsibilities.required'  => 'This field is required',
          ];
          $this->validate($request, $rules, $customMessages);
  
          $data =[
              'id'                    => $request->id,
              'CeaProgrammeId'        => $request->club,
              'StdStudentId'          => $request->student,
              'JoiningDate'           => $request->date,
              'Responsibility'        => $request->responsibilities,
              'Status'                => $request->status
          ];
          $response_data = CeaClubMembership::where('id', $id)->update($data);
        }
        else{
            $rules = [
                'student'                    => 'required',
                'club'                       => 'required',
                'responsibilities'           => 'required',
            ];
    
            $customMessages = [
                'student.required'           => 'This field is required',
                'club.required'              => 'This field is required',
                'responsibilities.required'  => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);
    
            $data =[
                'id'                    => $request->id,
                'CeaProgrammeId'        => $request->club,
                'StdStudentId'          => $request->student,
                'JoiningDate'           => $request->date,
                'Responsibility'        => $request->responsibilities,
                'Status'                => $request->status
            ];
            // dd($data);
            try{
                $response_data = CeaClubMembership::create($data);
                } catch(\Illuminate\Database\QueryException $ex){
                    dd($ex->getMessage());
                    // Note any method of class PDOException can be called on $ex.
                }
            
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

          //Fix once the roles have been decided
          
          // $assigned_student_details = $data['role'];
          
          // unset($data['role']);
          // $response = CeaProgrammeMembership::create($data);
          // $lastInsertId = $response->id;
  
          // foreach($assigned_student_details as $key => $value){
          //     $assigned_std_data['CeaSchoolProgrammeId'] = $data['CeaSchoolProgrammeId'];
          //     $assigned_std_data['CeaRoleId'] = $value;
          //     $assigned_std_data['StdStudentId'] = $data['StdStudentId'];
  
          //     $response_data = CeaRoleStudent::create($assigned_std_data);
          // }
          
      }



    /*
    * Function is to list Club Members
    */

    public function listClubMembers($param=""){
        $org_id = $param;
        $response_data = DB::table('cea_club_membership')
                            ->leftjoin('cea_programme', 'cea_club_membership.CeaProgrammeId', '=', 'cea_programme.id')
                            ->leftjoin('std_student', 'cea_club_membership.StdStudentId', '=', 'std_student.id')
                            ->select('cea_club_membership.*', 'cea_programme.name AS program_name',
                                'std_student.Name AS student_name', 'std_student.student_code AS student_code')
                            ->where('std_student.OrgOrganizationId', $org_id)
                            ->get();

        return $this->successResponse($response_data);

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
           //  'CeaProgrammeId'        => $request->program,
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
=======
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
use App\Models\Students\CeaClubMembership;
use App\Models\Students\CeaRoleStaff;
use App\Models\Students\CeaRoleStudent;
use App\Models\Masters\CeaProgramType;
use App\Models\Masters\StudentClub;



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
            // 'assigned_staff'            => $request->assigned_staff
        ];

        if($request->record_type == 'add'){
            $response_data = CeaSchoolProgramme::create($data);
        } else {
            $school_data = CeaSchoolProgramme::where('id',$request->id)->first();
            $data =$data+[
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>   date('Y-m-d h:i:s'),
            ];
            CeaSchoolProgramme::where('id',$school_data->id)->update($data);
            $response_data = CeaSchoolProgramme::first();
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Function is to load the list of student Programs
    */

    public function loadStudentPrograms($param=""){
        $org_id = $param;
        //commented by Tshewang and added CeaProgrammeTypeId in the select statement for creating program and clubs in organizaiton
        // $program_type = CeaProgramType::where('Name', 'like', 'Program%')->select('id')->first();
        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_supporter', 'cea_school_programme.CeaProgrammeSupporterId', '=', 'cea_programme_supporter.id')
                ->select('cea_school_programme.*','CeaProgrammeTypeId', 'cea_programme.name AS program_name', 'cea_programme_supporter.name AS supporter_name' )
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                // ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $program_type = CeaProgramType::where('Name', 'like', 'Program%')->select('id')->first();
        $org_id = $param;

        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_school_programme.id', 'cea_programme.name AS name', 'cea_programme.id AS programme_id')
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Function is to load the list of student clubs
    */

    public function loadStudentClubs($param=""){
        $program_type = CeaProgramType::where('Name', 'like', 'Club%')->select('id')->first();
        $org_id = $param;
        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_supporter', 'cea_school_programme.CeaProgrammeSupporterId', '=', 'cea_programme_supporter.id')
                ->select('cea_school_programme.*', 'cea_programme.name AS program_name', 'cea_programme_supporter.name AS supporter_name' )
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentClubs($param=""){
        $org_id = $param;
        $program_type = CeaProgramType::where('Name', 'like', 'Club%')->select('id')->first();

        $records = DB::table('cea_school_programme')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_school_programme.id', 'cea_programme.name AS name', 'cea_programme.id AS programme_id')
                ->where('cea_school_programme.OrgOrganizationId', $org_id)
                ->where('cea_programme.CeaProgrammeTypeId', $program_type->id)
                ->get();

        return $this->successResponse($records);
    }

    /**
     * Get the Program Details given a program id
     */

    public function getProgramDetails($param=""){
        $id = $param;

        $response_data=CeaSchoolProgramme::where('id',$id)->first();
        //$response_data->roles=CeaRoleStaff::where('CeaSchoolProgrammeId',$id)->get();
        return $this->successResponse($response_data);
    }

    /*
    * Save Program Members
    */

    public function saveProgramMembers(Request $request){
        $id = $request->id;
        if( $id != null && $id!= null){
        $rules = [
            'student'                    => 'required',
            'program'                    => 'required',
            'responsibilities'           => 'required',
        ];

        $customMessages = [
            'student.required'           => 'This field is required',
            'program.required'           => 'This field is required',
            'responsibilities.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                    => $request->id,
            'CeaProgrammeId'        => $request->program,
            'StdStudentId'          => $request->student,
            'JoiningDate'           => $request->date,
            'Responsibility'        => $request->responsibilities,
            'Status'                => $request->status
        ];
        try{
            $response_data=CeaProgrammeMembership::where('id', $id)->update($data);

            } catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
                // Note any method of class PDOException can be called on $ex.
            }
        // $response_data = CeaProgrammeMembership::where('id', $id)->update($data);
    }
      else {
        $rules = [
            'student'                    => 'required',
            'program'                    => 'required',
            'responsibilities'           => 'required',
        ];

        $customMessages = [
            'student.required'           => 'This field is required',
            'program.required'           => 'This field is required',
            'responsibilities.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                    => $request->id,
            'CeaProgrammeId'        => $request->program,
            'StdStudentId'          => $request->student,
            'JoiningDate'           => $request->date,
            'Responsibility'        => $request->responsibilities,
            'Status'                => $request->status
        ];
        $response_data = CeaProgrammeMembership::create($data);
      }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

        //Fix once the roles have been decided

        // $assigned_student_details = $data['role'];

        // unset($data['role']);
        // $response = CeaProgrammeMembership::create($data);
        // $lastInsertId = $response->id;

        // foreach($assigned_student_details as $key => $value){
        //     $assigned_std_data['CeaSchoolProgrammeId'] = $data['CeaSchoolProgrammeId'];
        //     $assigned_std_data['CeaRoleId'] = $value;
        //     $assigned_std_data['StdStudentId'] = $data['StdStudentId'];

        //     $response_data = CeaRoleStudent::create($assigned_std_data);
        // }

    }

    /*
    * Function is to list Program Members
    */

    public function listProgramMembers($param=""){
        $org_id = $param;

        $response_data = DB::table('cea_programme_membership')
                            ->join('cea_programme', 'cea_programme_membership.CeaProgrammeId', '=', 'cea_programme.id')
                            ->join('std_student', 'cea_programme_membership.StdStudentId', '=', 'std_student.id')
                            ->select('cea_programme_membership.*', 'cea_programme.name AS program_name',
                                'std_student.Name AS student_name', 'std_student.student_code AS student_code')
                            ->where('std_student.OrgOrganizationId', $org_id)
                            ->get();

        return $this->successResponse($response_data);

    }

    /*
    * Save Program Members
    */

    public function saveClubMembers(Request $request){
        $id = $request->id;
        if( $id != null && $id!= null){
        $rules = [
              'student'                    => 'required',
              'club'                       => 'required',
              'responsibilities'           => 'required',
          ];

          $customMessages = [
              'student.required'           => 'This field is required',
              'club.required'               => 'This field is required',
              'responsibilities.required'  => 'This field is required',
          ];
          $this->validate($request, $rules, $customMessages);

          $data =[
              'id'                    => $request->id,
              'CeaProgrammeId'        => $request->club,
              'StdStudentId'          => $request->student,
              'JoiningDate'           => $request->date,
              'Responsibility'        => $request->responsibilities,
              'Status'                => $request->status
          ];
          $response_data = CeaClubMembership::where('id', $id)->update($data);
        }
        else{
            $rules = [
                'student'                    => 'required',
                'club'                       => 'required',
                'responsibilities'           => 'required',
            ];

            $customMessages = [
                'student.required'           => 'This field is required',
                'club.required'              => 'This field is required',
                'responsibilities.required'  => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);

            $data =[
                'id'                    => $request->id,
                'CeaProgrammeId'        => $request->club,
                'StdStudentId'          => $request->student,
                'JoiningDate'           => $request->date,
                'Responsibility'        => $request->responsibilities,
                'Status'                => $request->status
            ];
            // dd($data);
            try{
                $response_data = CeaClubMembership::create($data);
                } catch(\Illuminate\Database\QueryException $ex){
                    dd($ex->getMessage());
                    // Note any method of class PDOException can be called on $ex.
                }

        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

          //Fix once the roles have been decided

          // $assigned_student_details = $data['role'];

          // unset($data['role']);
          // $response = CeaProgrammeMembership::create($data);
          // $lastInsertId = $response->id;

          // foreach($assigned_student_details as $key => $value){
          //     $assigned_std_data['CeaSchoolProgrammeId'] = $data['CeaSchoolProgrammeId'];
          //     $assigned_std_data['CeaRoleId'] = $value;
          //     $assigned_std_data['StdStudentId'] = $data['StdStudentId'];

          //     $response_data = CeaRoleStudent::create($assigned_std_data);
          // }

      }



    /*
    * Function is to list Club Members
    */

    public function listClubMembers($param=""){
        $org_id = $param;
        $response_data = DB::table('cea_club_membership')
                            ->leftjoin('cea_programme', 'cea_club_membership.CeaProgrammeId', '=', 'cea_programme.id')
                            ->leftjoin('std_student', 'cea_club_membership.StdStudentId', '=', 'std_student.id')
                            ->select('cea_club_membership.*', 'cea_programme.name AS program_name',
                                'std_student.Name AS student_name', 'std_student.student_code AS student_code')
                            ->where('std_student.OrgOrganizationId', $org_id)
                            ->get();

        return $this->successResponse($response_data);

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
            'CeaProgrammeId'        => $request->program,
            'ForMonth'              => $request->month,
            'Remarks'               => $request->remarks,
            // 'inventoryDetails'      => $request->inventoryDetails,
            // 'productionDetails'     => $request->productionDetails,
            // 'expenditureDetails'    => $request->expenditureDetails,
            //'user_id'        => $this->user_id()
        ];
        // $inventory_details      = $data['inventoryDetails'];
        // $production_details     = $data['productionDetails'];
        // $expenditure_details    = $data['expenditureDetails'];

        // unset($data['inventoryDetails']);
        // unset($data['productionDetails']);
        // unset($data['expenditureDetails']);
        $response = CeaProgramInventory::create($data);
        $lastInsertId = $response->id;
        foreach($request->inventoryDetails as $key => $value){
            $inventory_data['CeaProgrammeInventoryId'] = $lastInsertId;
            $inventory_data['CeaProgrammeInventoryItemId'] = explode('_',$value['item_id'])[0];
            $inventory_data['IncreaseInQuantity'] = $value['increase_quantity'];
            $inventory_data['DecreaseInQuantity'] = $value['decrease_quantity'];
            $inventory_data['Remarks'] = $value['remarks'];
            // dd($inventory_data);
            CeaProgramInventoryDetail::create($inventory_data);
        }

        foreach($request->productionDetails as $key => $value){
            $production_data['CeaProgrammeInventoryId'] = $lastInsertId;
            $production_data['CeaProgrammeInventoryItemId'] = explode('_',$value['item_produced'])[0];
            $production_data['QuantityProduced'] = $value['quantity_produced'];
            $production_data['NoOfVariety'] = $value['no_varieties'];
            $production_data['AmountGenerated'] = $value['amount_generated'];
            $production_data['Remarks'] = $value['production_remarks'];
            CeaProgramInventoryProduction::create($production_data);
        }
        foreach($request->expenditureDetails as $key => $value){
            $expenditure_data['CeaProgrammeInventoryId'] = $lastInsertId;
            $expenditure_data['Particular'] = $value['expenditure_details'];
            $expenditure_data['Amount'] = $value['expenditure_amount'];
            $expenditure_data['Remarks'] = $value['expenditure_remarks'];
            $expenditure_response = CeaProgramInventoryExpenditure::create($expenditure_data);
        }
        //dd( $data);
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
>>>>>>> 39ab2186619822b52e38115b7de193158be375c4
