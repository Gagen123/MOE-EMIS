<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Masters\Stream;
use App\Models\Masters\Classes;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class StreamController extends Controller
{
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    

    /**
     * method to get class in dropdown
     */
    public function getClassInDropdown(){
        return Classes::get(['id','class']);
    }

    /**
     * method to list stream
    */
    
    public function loadStream(){
        $stream = Stream::all();
        return $stream;
    }

    /**
     * method to save stream
     */
    public function saveStream(Request $request){
        $id = $request->id;
        if( $id != null){
            $cla = [
                'stream'         => $request['streamName'],
                'status'         => $request['status'],
                'updated_by'     =>$request['user_id'],
                'created_at'     =>date('Y-m-d h:i:s'),
            ];
            $data = Stream::find($request['id']);
            $messs_det='streamName:'.$data->stream.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','stream','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $class = Stream::where('id', $id)->update($cla);
            return $this->successResponse($class, Response::HTTP_CREATED);
        }else{

            $cla = [
                'stream'         => $request['streamName'],
                'status'         => $request['status'],
                'created_by'     =>$request['user_id'],
                'created_at'     =>date('Y-m-d h:i:s'),
            ];

            $class = Stream::create($cla);
            return $this->successResponse($class, Response::HTTP_CREATED);
        }
    }
}
