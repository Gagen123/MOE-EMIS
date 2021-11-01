<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use App\Models\Masters\StudentAwards;
use App\Models\Students\Student;
use App\Models\Students\StudentRollNumber;


class GeneralStudentController extends Controller
{
    //
    use ApiResponser;
    public $database = "student_db";
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * Get the basic student list (id, name, student code)
     */

    public function loadStudentList($param = "")
    {
        $id = $param;
        return $this->successResponse(Student::where('OrgOrganizationId', $id)->where('IsTransferred', '0')
            ->get(['id', 'Name', 'student_code']));
    }

    /**
     * Get the basic student list (id, name, student code, class, section, stream, sex)
     */

    public function loadBasicStudentList($param = "")
    {
        $id = $param;
        $records = DB::table('std_student')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->select(
                'std_student.id AS id',
                'std_student.Name',
                'std_student.student_code',
                'std_student.DateOfBirth',
                'std_student.CmnSexId',
                'std_student.CmnSexId',
                'std_student_class_stream.OrgClassStreamId',
                'std_student_class_stream.SectionDetailsId'
            )
            ->where('std_student.OrgOrganizationId', $id)
            ->where('IsTransferred', '0')
            ->get();
        return $records;
    }

    /**
     * Get the student class details for a given student
     * param is student id
     */

    public function getStudentClassId($std_id = "")
    {
        $records = DB::table('std_student')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->select('std_student_class_stream.OrgClassStreamId')
            ->where('std_student.id', $std_id)
            ->get();
        return $records;
    }

    /**
     * Get the student list by stream and section (id, name, student code, class, section, stream)
     */

    public function loadStudentBySection($param1)
    {
        $id = $param1;
        $class_details = explode('__', $id);

        $records = DB::table('std_student')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->select(
                'std_student.id AS id',
                'std_student.Name',
                'std_student.student_code',
                'std_student.DateOfBirth',
                'std_student.CmnSexId',
                'std_student_class_stream.OrgClassStreamId',
                'std_student_class_stream.SectionDetailsId'
            )
            ->where('std_student_class_stream.OrgClassStreamId', $class_details[0])
            ->where('std_student_class_stream.SectionDetailsId', $class_details[2])
            //->where('academicYear', date('Y'))
            ->get();
        return $records;
    }

    public function loadStudentByType($type, $class_id)
    {

        $records = DB::table('std_student')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->join('std_student_type', 'std_student.stdType', '=', 'std_student_type.id')
            ->select(
                'std_student.id AS id',
                'std_student.Name',
                'std_student.student_code',
                'std_student.DateOfBirth',
                'std_student.CmnSexId',
                'std_student_class_stream.OrgClassStreamId',
                'std_student.noOfMeals',
                'std_student.scholarshipType',
                'std_student.isBoarder'
            )
            ->where('std_student_class_stream.OrgClassStreamId', $class_id)
            ->where('std_student_type.Name', $type)
            //->where('academicYear', date('Y'))
            ->get();
        return $records;
    }

    /**
     * Function will sort student list by name (ASC or DEC) and gender
     */

    public function loadStudentBySectionForRollNo($data)
    {
        //get the array from the url parameters
        parse_str($data, $data_parameters);

        $gender_params = $data_parameters['gender_params'];
        $gender = [];
        foreach ($gender_params as $data_values) {
            foreach ($data_values as $key => $value) {
                if ($value['name'] == 'Female') {
                    $gender['Female'] = $value['id'];
                }
                if ($value['name'] == 'Male') {
                    $gender['Male'] = $value['id'];
                }
            }
        }

        $form_params = $data_parameters['form_params'];

        $form_details = explode('__', $form_params);

        $gender_1 = '';
        $gender_2 = '';

        if ($form_details[4] == 'Male') {
            $gender_1 = 'Male';
            $gender_2 = 'Female';
        } else {
            $gender_1 = 'Female';
            $gender_2 = 'Male';
        }

        if ($form_details[4] == 'Mixed') {
            $records = DB::table('std_student')
                ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
                ->select(
                    'std_student.id AS id',
                    'std_student.Name',
                    'std_student.student_code',
                    'std_student.DateOfBirth',
                    'std_student.CmnSexId',
                    'std_student_class_stream.OrgClassStreamId',
                    'std_student_class_stream.SectionDetailsId'
                )
                ->where('std_student_class_stream.OrgClassStreamId', $form_details[0])
                ->where('std_student_class_stream.SectionDetailsId', $form_details[2])
                ->orderBy('std_student.Name', 'ASC')
                ->get();

            return $records;
        } else {
            $first_record = $this->orderStudentByGender($gender[$gender_1], $form_details[0], $form_details[2], $form_details[3]);
            $second_record = $this->orderStudentByGender($gender[$gender_2], $form_details[0], $form_details[2], $form_details[3]);

            $records = $first_record->merge($second_record);
            return $records;
        }
    }

    /**
     * Function to sort Students by Name based on gender
     *
     * This function is used only by loadStudentBySectionForRollNo
     */

    private function orderStudentByGender($gender, $OrgClassStreamId, $SectionDetailsId, $order)
    {
        $records = DB::table('std_student')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->select(
                'std_student.id AS id',
                'std_student.Name',
                'std_student.student_code',
                'std_student.DateOfBirth',
                'std_student.CmnSexId',
                'std_student_class_stream.OrgClassStreamId',
                'std_student_class_stream.SectionDetailsId'
            )
            ->where('std_student_class_stream.OrgClassStreamId', $OrgClassStreamId)
            ->where('std_student_class_stream.SectionDetailsId', $SectionDetailsId)
            ->where('std_student.CmnSexId', $gender)
            ->orderBy('std_student.Name', $order)
            ->get();

        return $records;
    }

    /**
     * Get the student list by class
     *
     * This function gets all the basic details such as feeding, scholarship etc.
     * If you want only student and class, create another function
     */
    public function saveStudentRollNumber(Request $request)
    {
        if ($request->studentList != null && $request->studentList != "") {
            foreach ($request->studentList as $details) {
                $rollNo = [
                    'std_class'             => $request->std_class,
                    'std_stream'            => $request->std_stream,
                    'std_section'           => $request->std_section,
                    'organization_id'       => $request->organization_id,
                    'user_id'               => $request->user_id,
                    'roll_no'               => $details['roll_no'],
                    'Name'                  => $details['Name'],
                    'student_code'          => $details['student_code'],
                    'std_id'                => $details['id'],
                ];
                $response_data = StudentRollNumber::create($rollNo);
            }
            return $response_data;
        }
    }

    public function loadStudentByClass($class)
    {
        $id = $class;

        $records = DB::table('std_student')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->select(
                'std_student.id AS id',
                'std_student.Name',
                'std_student.student_code',
                'std_student.DateOfBirth',
                'std_student.CmnSexId',
                'std_student_class_stream.OrgClassStreamId',
                'std_student.noOfMeals',
                'std_student.scholarshipType',
                'std_student.isBoarder'
            )
            ->where('std_student_class_stream.OrgClassStreamId', $class)
            //->where('academicYear', date('Y'))
            ->get();
        return $records;
    }

    /**
     * Load student list by gender
     *
     * Takes class, stream and section as parameter separated by __ (double underscore)
     * We get the gender from master and pass it as an argument in an array
     */

    public function studentListByGender($data = "")
    {
        //get the array from the url parameters
        parse_str($data, $data_parameters);

        $gender_params = $data_parameters['gender_params'];
        $class_params = $data_parameters['class_params'];
        $org_id = $data_parameters['organization_id'];

        $class_details = explode('__', $class_params);
        $vaccine_type = $class_details[3];
        $vaccine_query = $this->getVaccinationFor($vaccine_type);
        $vaccine_for = $vaccine_query->vaccineFor;

        $gender = NULL;

        if ($vaccine_for == '1') {
            foreach ($gender_params as $data_values) {
                foreach ($data_values as $key => $value) {
                    if ($value['name'] == 'Male') {
                        $gender = $value['id'];
                    }
                }
            }
        }
        if ($vaccine_for == '2') {
            foreach ($gender_params as $data_values) {
                foreach ($data_values as $key => $value) {
                    if ($value['name'] == 'Female') {
                        $gender = $value['id'];
                    }
                }
            }
        }

        $query = "SELECT t1.OrgOrganizationId AS org_id, t1.id AS std_student_id, t1.Name, t1.student_code, t1.DateOfBirth, t1.CmnSexId,
                            t2.OrgClassStreamId, t2.SectionDetailsId
                    FROM std_student t1
                    LEFT JOIN std_student_class_stream t2 ON t1.id = t2.StdStudentId
                    WHERE t1.OrgOrganizationId = ? AND t2.OrgClassStreamId = ? AND t2.SectionDetailsId = ? ";

        $params = [$org_id, $class_details[0], $class_details[2]];

        if ($gender) {
            $query .= ' AND t1.CmnSexId = ?';
            array_push($params, $gender);
        }

        return $this->successResponse(DB::select($query, $params));
    }

    /**
     * Get Student List by orgid and org classstreamId
     */

    public function getStudentList($orgId, $orgClassStreamId)
    {
        $data = DB::table('std_student as a')
            ->join('std_student_class_stream as b', 'a.id', '=', 'b.StdStudentId')
            ->select('a.id', 'a.Name')
            ->where('a.OrgOrganizationId', $orgId)
            ->where('b.OrgClassStreamId', $orgClassStreamId)
            ->get();
        return $data;
    }

    public function getStudents($org_id, Request $request)
    {

        $query = "SELECT t1.OrgOrganizationId AS org_id, t1.id AS std_student_id,t1.student_code,t1.DateOfBirth AS dob,t1.Name,t2.roll_no, t1.CidNo, t3.OrgClassStreamId, t3.SectionDetailsId
            FROM std_student t1
            JOIN student_rollnumbers t2 ON t1.id = t2.std_id
            JOIN std_student_class_stream t3 ON t1.id = t3.StdStudentId WHERE t1.IsTransferred  = 0 AND t1.OrgOrganizationId = ? AND t3.OrgClassStreamId = ?";
        $params = [$org_id, $request->OrgClassStreamId];

        if ($request->sectionId) {
            $query .= ' AND t3.SectionDetailsId = ?';
            array_push($params, $request->sectionId);
        }

        return $this->successResponse(DB::select($query, $params));
    }

    /**
     * For Profile
     * Get Student, Parents, Roles and Responsibilities and Programme/Club Membership of the Student
     *
     * id is the student id
     */

    public function getStudentDetails($id)
    {
        $records = DB::table('std_student')
            ->where('std_student.id', $id)
            ->get();
        return $records;
    }

    public function getStudentParentsDetails($id)
    {
        $records = DB::table('std_student')
            ->join('std_student_guardian', 'std_student.id', '=', 'std_student_guardian.StdStudentId')
            ->where('std_student.id', $id)
            ->get();
        return $records;
    }

    public function getStudentRoleDetails($id)
    {
        $records = DB::table('std_role_student')
            ->join('std_student', 'std_role_student.StdStudentId', '=', 'std_student.id')
            ->join('std_role', 'std_role_student.StdRoleId', '=', 'std_role.id')
            ->select('std_role_student.*', 'std_student.Name', 'std_student.OrgOrganizationId', 'std_role.name AS role_name')
            ->where('std_student.id', $id)
            ->get();
        return $records;
    }

    public function getStudentProgrammeDetails($id)
    {
        $records = DB::table('cea_programme_membership')
            ->join('cea_programme', 'cea_programme_membership.CeaProgrammeId', '=', 'cea_programme.id')
            ->join('std_student', 'cea_programme_membership.StdStudentId', '=', 'std_student.id')
            ->select(
                'cea_programme_membership.*',
                'cea_programme.name AS program_name',
                'std_student.Name AS student_name',
                'std_student.student_code AS student_code'
            )
            ->where('std_student.id', $id)
            ->get();
        return $records;
    }

    /**
     * To get the whether the vaccination is for both, boys or girls
     */

    private function getVaccinationFor($vaccine_type)
    {
        $vaccine = DB::table('std_vaccine_type')
            ->select('std_vaccine_type.vaccineFor AS vaccineFor')
            ->where('std_vaccine_type.id', $vaccine_type)
            ->first();
        return $vaccine;
    }

    /**
     * Load the student information e.g. no. of boys and girls
     *
     * $param takes the value such as general, SEN etc
     */

    public function loadStudentInformation($org_id, $param)
    {
        if ($param == 'general') {
            $records = DB::table('std_student')
                ->select('std_student.CmnSexId', DB::raw("COUNT(std_student.CmnSexId) as sex"))
                ->groupBy('std_student.CmnSexId')
                ->where('OrgOrganizationId', $org_id)
                ->get();
        }
        if ($param == 'sen') {
            $records = DB::table('std_student')
                ->select('std_student.CmnSexId', DB::raw("COUNT(std_student.isSen) as sen"))
                ->groupBy('std_student.CmnSexId')
                ->where('OrgOrganizationId', $org_id)
                ->get();
        }


        return $records;
    }

    public function loadStudentListByOrgId($org_id)
    {
        $student = DB::table('std_student AS t')
            ->select('t.Name', 't.id')
            ->where('OrgOrganizationId', '=', $org_id)
            ->get();
        return $student;
    }
}
