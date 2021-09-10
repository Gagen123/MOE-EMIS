<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\ClassMapping;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;
use App\Models\Masters\ClassStream;
use App\Models\generalInformation\SectionDetails;
use App\Models\OrganizationClassSubject;
use Exception;

class ClassMappingController extends Controller
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

    public function saveClassMapping(Request $request){
        // foreach ($classes as $cls){
        //     $class = [
        //         'organizationId'    => $request->school,
        //         'classId'           => $cls,
        //         'created_by'        => $request->user_id,
        //         'created_at'        => date('Y-m-d h:i:s'),
        //     ];

        //     $cla = ClassMapping::create($class);
        // }
        $existclassStream=OrganizationClassStream::where('organizationId',$request->school)->get();
        if(sizeof($existclassStream)>0){
            foreach($existclassStream as $cls){
                SectionDetails::where('classSectionId',$cls['id'])->delete();
            }
        }
        OrganizationClassStream::where('organizationId',$request->school)->delete();
        $response_data="";
        if($request->class){
            foreach($request->class as $key => $classId){
                $stream_exists = $this->checkStreamExists($classId);
                if(empty($stream_exists)){
                    $multigrade="";
                    $ismultigrade='';
                    if($request->multiAgeId!=""){
                        foreach($request->multiAgeId as $sec => $multiage){
                            if(explode('__',$multiage)[0]==$classId){
                                $multigrade=explode('__',$multiage)[1];
                                $ismultigrade=1;
                            }
                        }
                    }
                    $classStream = [
                        'organizationId'        => $request->school,
                        'classId'               => $classId,
                        'streamId'              => '',
                        'isMultiGrade'          => $ismultigrade,
                        'multiGradeId'          => $multigrade,
                        'created_by'            => $request->user_id,
                        'created_at'            => date('Y-m-d h:i:s'),
                    ];
                    $class = OrganizationClassStream::create($classStream);
                    if($request->sections!=null && $request->sections!=""){
                        foreach($request->sections as $sec => $secion){
                            if(explode('#',$secion)[0]==$classId){
                                $section_details = array(
                                    'classSectionId'    =>  $class->id,
                                    'section'           =>  explode('#',$secion)[1],
                                );
                                $sec = SectionDetails::create($section_details);
                            }
                        }
                    }
                }
            }
        }

        if($request->stream!=null && $request->stream!=""){
            foreach($request->stream as $key2 => $classStreamId){
                // $class_stream_data = $this->getClassStreamId($classStreamId);
                $class_stream_data = ClassStream::where('id',$classStreamId)->first();
                $classStream = [
                    'organizationId'        => $request->school,
                    'classId'               => $class_stream_data->classId,
                    'streamId'              => $class_stream_data->streamId,
                    'created_by'            => $request->user_id,
                    'created_at'            => date('Y-m-d h:i:s'),
                ];
                $response_data = OrganizationClassStream::create($classStream);
                if($request->sections!=null && $request->sections!=""){
                    foreach($request->sections as $sec => $secion){
                        if(explode('#',$secion)[0]==$classStreamId){
                            $section_details = array(
                                'classSectionId'    =>  $response_data->id,
                                'section'           =>  explode('#',$secion)[1],
                            );
                            $sec = SectionDetails::create($section_details);
                        }
                    }
                }
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }


    private function checkStreamExists($classId){
        $data = DB::table('class_stream_mappings')
            ->select('streamId', 'classId')
            ->where('classId', $classId)
            ->get()
            ->toArray();
        return $data;

    }

    /**
     * Get class and stream id based on id
     */
    private function getClassStreamId($id){
        $data = DB::table('class_stream_mappings')
            ->select('classId', 'streamId')
            ->where('id', $id)
            ->get()
            ->toArray();
        return $data;
    }
    private function getmappingId($classId="", $streamid=""){
        $data = DB::table('class_stream_mappings')
            ->select('id')
            ->where('classId', $classId)
            ->where('streamId', $streamid)
            ->first();
        return $data;
    }

    public function getCurrentClassStream($school_id=""){
        $response_data = OrganizationClassStream::where('organizationId',$school_id)->get();
        if($response_data!=null && $response_data!=""){
            foreach($response_data as $class_stream){
                if($class_stream['streamId']!=null && $class_stream['streamId']!=""){
                    // dd($this->getmappingId($class_stream['classId'],$class_stream['streamId'])->id);
                    $class_stream->classStreamId= $this->getmappingId($class_stream['classId'],$class_stream['streamId'])->id;
                }
                else{
                    $class_stream->classStreamId= "";
                }
                $class_stream->sectionCount=SectionDetails::where('classSectionId',$class_stream['id'])->count();
            }
        }
        return $response_data;
    }

    public function saveSubjectMapping(Request $request){
        $response_data="";
        if($request->data!=null && $request->data!=""){
            foreach($request->data as $subject){
            $classStream = [
                    'organizationId'  => $request->org_id,
                    'classId'         => $subject['org_class_id'],
                    'subjectId'       => $subject['aca_sub_id'],
                    'created_by'      => $request->user_id,
                    'created_at'      => date('Y-m-d h:i:s'),
                ];
                if(isset($subject['org_stream_id'])){
                    $classStream['streamId'] = $subject['org_stream_id'];
                }
                if(isset($subject['org_section_id'])){
                    $classStream['sectionId'] = $subject['org_section_id'];
                }
                $response_data= OrganizationClassSubject::create($classStream);
            }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getSubjectMapping($org_id=""){
        try{
        $response_data = DB::select("SELECT t1.id,t1.organizationId, t1.classId,t1.streamId,t1.sectionId,t1.subjectId AS aca_sub_id,t2.class, t3.stream
        FROM organization_class_subject t1 JOIN classes t2 ON t1.classId = t2.id LEFT JOIN streams t3 ON t1.streamId = t3.id WHERE t1.organizationId = ?",[$org_id]);
        return $response_data;}catch(Exception $e){
            dd($e);
        }
    }

}
