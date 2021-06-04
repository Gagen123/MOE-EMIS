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
                    $classStream = [
                        'organizationId'        => $request->school,
                        'classId'               => $classId,
                        'streamId'              => '',
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

}
