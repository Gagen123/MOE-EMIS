<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Projection;
use App\Models\generalInformation\Feeder;
use App\Models\generalInformation\FeederStudents;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;
use App\Models\Masters\Classes;

class ProjectionsController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function saveProjections(Request $request){
        $id = $request->id;
        if( $id != null){
            $projection = [
                'organizationId'                        =>  $request['organizationId'],
                'academicYear'                          =>  $request['academicYear'],
                'ProjectionNo'                          =>  $request['class_projections'],
                'class'                                 =>  $request['class'],
                'remarks'                               =>  $request['remarks'],
                'updated_by'                            =>  $request->user_id,
                'created_at'                            =>  date('Y-m-d h:i:s')
            ];
            $spo = Projection::where('id', $id)->update($projection);
            return $this->successResponse($spo, Response::HTTP_CREATED);

            }else{
                $organizationId  = $request['organizationId'];
                foreach ($request->class_projections as $i=> $item){
                    $remarks="";
                    if(isset($item['remarks'])){
                        $remarks=$item['remarks'];
                    }
                    $projection = array(
                        'organizationId'                        =>  $organizationId,
                        'academicYear'                          =>  $request['academicYear'],
                        'ProjectionNo'                          =>  $item['ProjectionNo'],
                        'class'                                 =>  $item['id'],
                        'remarks'                               =>  $remarks,
                        'updated_by'                            =>  $request->user_id,
                        'created_at'                            =>  date('Y-m-d h:i:s')
                    );
                 $localpro = Projection::create($projection);
                }
                return $this->successResponse($localpro, Response::HTTP_CREATED);
            }

    }

    public function saveFeeders(Request $request){
        $id = $request->id;

        if( $id != null){
                $feeder = array(
                    'parentschool'              => $request->parent_school,
                    'class'                     => $request->class,
                    'feederschool'              =>  $request->feederschool,
                    'remarks'                   =>  $request->remarks,
                    'created_by'                =>  $request->user_id,
                    'updated_at'                =>  date('Y-m-d h:i:s')
                );
                $spo = Feeder::where('id', $id)->update($feeder);
                return $this->successResponse($spo, Response::HTTP_CREATED);

        }else{
            foreach ($request->feederschool as $i=> $school){
                $feeder = array(
                    'parentschool'              => $request->parent_school,
                    'class'                     => $request->class,
                    'feederschool'              =>  $school['feederschool'],
                    'remarks'                   =>  $request['remarks'],
                    'created_by'                =>  $request->user_id,
                    'updated_at'                =>  date('Y-m-d h:i:s')

                );

                $localpro = Feeder::create($feeder);
            }
            return $this->successResponse($localpro, Response::HTTP_CREATED);
        }

    }

    public function loadProjections($orgId=""){
        $projections = DB::table('organization_projections')
                        ->join('organization_class_streams', 'organization_class_streams.id','=','organization_projections.class')
                        ->join('classes', 'classes.id','=','organization_class_streams.classId')
                        ->select('organization_projections.id', 'organization_projections.academicYear','organization_projections.ProjectionNo',
                                    'classes.class as class', 'organization_projections.class as classId')
                        ->where('organization_projections.organizationId', $orgId)
                        ->get();
        return $projections;
    }

    public function loadFeeders($dzoId=""){
        $feeder = DB::table('organization_feeder')
                        ->join('organization_details as t1', 't1.id','=','organization_feeder.feederschool')
                        ->join('organization_details as t2', 't2.id','=','organization_feeder.parentschool')
                        ->select('organization_feeder.id', 'organization_feeder.class', 'organization_feeder.parentschool as parent_school',
                                    'organization_feeder.feederschool as feeder_school', 't1.name as feeder_name','t2.name as parent_name')
                        ->where('t1.dzongkhagId', $dzoId)
                        ->get();
        return $feeder;
    }

    public function saveFeederStudents(Request $request){
        $data = $request->all();
        unset($data['user_id']);
        unset($data['present_org']);
        $user_id = $request->user_id;
        $presentSchool = $request->present_org;
        foreach ($data as $school){
            $school_id = NULL;
            if(array_key_exists('org_id', $school)){
                $school_id = $school['org_id'];
            }
            
            $feeder = array(
                'StdStudentId'              =>  $school['id'],
                'presentSchool'             =>  $presentSchool,
                'StdName'                   =>  $school['Name'],
                'StdCode'                   =>  $school['student_code'],
                'parentschool'              =>  $school_id,
                'created_by'                =>  $user_id,
                'updated_at'                =>  date('Y-m-d h:i:s')
            );

            $response = FeederStudents::create($feeder);
        }
        return $this->successResponse($response, Response::HTTP_CREATED);
    }

    public function editFeederStudents(Request $request){
        $data = $request->all();
        $feeder = array(
            'parentschool'              =>  $request->parent_school,
        );
        $response = FeederStudents::where('id', $request->id)->update($feeder);
        return $this->successResponse($response, Response::HTTP_CREATED);
    }

    public function listParentSchool($org_id){
        $schools = DB::table('organization_feeder')
                        ->join('organization_details as t1', 't1.id','=','organization_feeder.feederschool')
                        ->join('organization_details as t2', 't2.id','=','organization_feeder.parentschool')
                        ->select('organization_feeder.id', 'organization_feeder.class', 'organization_feeder.parentschool as parent_school',
                                    'organization_feeder.feederschool as feeder_school', 't1.name as feeder_name','t2.name as parent_name')
                        ->where('organization_feeder.feederschool', $org_id)
                        ->get();
        return $schools;
    }

    public function loadFeederStudents($org_id){

        $schools = DB::table('organization_feeder_students')
                        ->leftjoin('organization_details as t1', 't1.id','=','organization_feeder_students.parentschool')
                        ->select('organization_feeder_students.*', 't1.name as parent_school_name')
                        ->where('organization_feeder_students.presentSchool', $org_id)
                        ->get();
        return $schools;
    }
    
}
