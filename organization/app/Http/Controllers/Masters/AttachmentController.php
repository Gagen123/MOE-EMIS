<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Masters\Attachment;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class AttachmentController extends Controller
{
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * method to save attachment
     */
    public function saveAttachment(Request $request){
        $id = $request->id;
        if( $id != null){
            $cla = [
                'name'           => $request['attachmentName'],
                'status'         => $request['status'],
                'updated_by'     => $request['user_id'],
                'created_at'     => date('Y-m-d h:i:s'),
            ];
            $data = Attachment::find($request['id']);
            $messs_det='attachmentName:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','attachment','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $class = Attachment::where('id', $id)->update($cla);
            return $this->successResponse($class, Response::HTTP_CREATED);
        }else{

            $cla = [
                'name'                    => $request['attachmentName'],
                'status'                  => $request['status'],
                'created_by'              => $request['user_id'],
                'created_at'              => date('Y-m-d h:i:s'),
            ];

            $class = Attachment::create($cla);
            return $this->successResponse($class, Response::HTTP_CREATED);
        }
    }

    /**
     * method to list attachment
    */
    
    public function loadAttachment(){
        $attachment = Attachment::all();
        return $attachment;
    }
}
