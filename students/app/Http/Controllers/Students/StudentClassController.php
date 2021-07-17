<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentClassAllocation;
use App\Models\Students\Student;

class StudentClassController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * method to save or update student Classes
    */

    public function saveStudentClassAllocation(Request $request){
        $data =[
            'id'                            => $request['id'],
            'class_section_stream'          => $request['class_section_stream'],
            'user_id'                       => $request['user_id'],
            'working_agency_id'             => $request['working_agency_id']
        ];

        $class_section_stream = $data['class_section_stream'];
        // dd($class_section_stream);
        //allocating the class
        foreach($class_section_stream as $key => $value){
            if(array_key_exists('orgClassStreamId', $value)){
                $check_value = StudentClassAllocation::where('OrgClassStreamId', '=', $value['orgClassStreamId'])->select('id')->first();
                //If not null, then
                $secId="NA";
                if(isset( $value['sectionId'] )){
                    $secId=$value['sectionId'];
                }
                if($check_value != NULL || (!empty($check_value))){
                    // $deletedRows = StudentClassAllocation::where('OrgClassStreamId', '=', $value['orgClassStreamId'])
                    //                 ->where('academicYear', '=', date('Y'))
                    //                 ->delete();

                    //insert after deleting
                    $class_allocation_data = [
                        'StdStudentId'          => $value['id'],
                        'OrgClassStreamId'      => $value['orgClassStreamId'],
                        'SectionDetailsId'      => $secId,
                        'academicYear'          => date('Y')
                    ];
                    $response_data = StudentClassAllocation::create($class_allocation_data);

                } else{
                    $class_allocation_data = [
                        'StdStudentId'          => $value['id'],
                        'OrgClassStreamId'      => $value['orgClassStreamId'],
                        'SectionDetailsId'      => $secId,
                        'academicYear'          => date('Y')
                    ];
                    $response_data = StudentClassAllocation::create($class_allocation_data);
                }
            }
            //updating the students No of Meals detail
            // if($value['noOfMeals'] != NULL){
            //     $meals=[
            //         'noOfMeals' => $value['noOfMeals']
            //     ];

            //     $no_meals = Student::where('id', $value['id'])->update($meals);
            // }

            //updating the students boarder detail
            // if($value['isBoarder'] != NULL){
            //     $boarder=[
            //         'isBoarder' => $value['isBoarder']
            //     ];

            //     $no_meals = Student::where('id', $value['id'])->update($boarder);
            // }

            //updating the students scholarship details
            // if($value['scholarshipType'] != NULL){
            //     $scholarship=[
            //         'scholarshipType' => $value['scholarshipType']
            //     ];

            //     $no_meals = Student::where('id', $value['id'])->update($scholarship);
            // }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }

    /**
     * method to list students masters
    */

    public function loadStudentClassAllocations($param=""){

        // $id =$param;

        // $awards = DB::table('cea_student_award')
        //         ->join('std_student', 'cea_student_award.StdStudentId', '=', 'std_student.id')
        //         ->join('cea_award', 'cea_student_award.CeaAwardId', '=', 'cea_award.id')
        //         ->select('cea_student_award.*', 'std_student.Name','cea_award.name AS award_name')
        //         ->where('std_student.OrgOrganizationId', $id)
        //         ->get();

        // return $this->successResponse($awards);

    }

    /**
     * Function to insert data into the respective tables
     */

    private function updateData($dataRequest, $databaseModel){

        $modelName = "App\\Models\\Masters\\"."$databaseModel";
        $model = new $modelName();

        $data = $model::find($dataRequest['id']);

        //Audit Trails
        // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");

        //data to be updated
        $data->name = $dataRequest['name'];
        $data->description = $dataRequest['description'];
        $data->status = $dataRequest['status'];
        $data->updated_by = $dataRequest['created_by'];
        $data->updated_at = date('Y-m-d h:i:s');
        $data->update();

        return $data;

    }
}
