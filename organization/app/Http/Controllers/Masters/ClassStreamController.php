<?php

namespace App\Http\Controllers\Masters;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Masters\ClassStream;
use App\Http\Controllers\Controller;

class ClassStreamController extends Controller
{
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function getClassStream(){
        $data = DB::select('SELECT t1.classId AS org_class_id, t1.streamId AS org_stream_id, t2.class, t3.stream FROM class_streams AS t1 JOIN classes AS t2 ON t1.classId=t2.id LEFT JOIN streams AS t3 ON t1.streamId = t3.id and t3.status=1 WHERE t2.status = 1 ORDER BY t2.class');
        return $this->successResponse($data, Response::HTTP_CREATED);
    }

    /**
     * method to save class stream mapping
     */

    public function saveClassStreamMapping(Request $request){

        
        $id = $request->id;
        if( $id != null){
            $cla = [
                'class'          => $request['className'],
                'status'         => $request['status'],
                'updated_by'     =>$request['user_id'],
                'created_at'     =>date('Y-m-d h:i:s'),
            ];
            $data = Classes::find($request['id']);
            $messs_det='className:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','class','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $class = Classes::where('id', $id)->update($cla);
            return $this->successResponse($class, Response::HTTP_CREATED);
        }else{

            $class_streams = $request['classStream'];
            foreach ($class_streams as $key => $value){
                $data_temp = explode('_', $value);
                $data = [
                    'classId'   => $data_temp[0],
                    'streamId'  => $data_temp[1]
                ];

                ClassStream::create($data);
            }
            return $this->successResponse($data, Response::HTTP_CREATED);
        }
    }

    public function loadClassStreamMapping(){

        $data = DB::table('classes')
                ->leftjoin('class_stream_mappings', 'classes.id', '=', 'class_stream_mappings.classId')
                ->leftjoin('streams', 'streams.id', '=', 'class_stream_mappings.streamId')
                ->select('class_stream_mappings.*', 'classes.class', 'classes.id AS classId', 'streams.id AS streamId', 'streams.stream')
                ->orderBy('classes.displayOrder', 'asc')
                ->get();

        return $this->successResponse($data, Response::HTTP_CREATED);
    }

}
