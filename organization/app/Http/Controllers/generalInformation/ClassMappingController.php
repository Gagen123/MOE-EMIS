<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\ClassMapping;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;

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
                } 
            }
        }

        if($request->stream!=null && $request->stream!=""){
            foreach($request->stream as $key2 => $classStreamId){
                $class_stream_data = $this->getClassStreamId($classStreamId);
                foreach($class_stream_data as $v){
                    $classStream = [
                        'organizationId'        => $request->school,
                        'classId'               => $v->classId,
                        'streamId'              => $v->streamId,
                        'created_by'            => $request->user_id,
                        'created_at'            => date('Y-m-d h:i:s'),
                    ];
                    $response_data = OrganizationClassStream::create($classStream);
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
                if($class_stream['streamId']!=!=null && $class_stream['streamId']!=""){
                    // dd($this->getmappingId($class_stream['classId'],$class_stream['streamId'])->id);
                    $class_stream->classStreamId= $this->getmappingId($class_stream['classId'],$class_stream['streamId'])->id;
                }
                else{
                    $class_stream->classStreamId= "";
                }
            }
        }
        return $response_data;
    }
}
