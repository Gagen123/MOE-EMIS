<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Masters\Classes;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    use ApiResponser;
    public $audit_database;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }
    
    /**
     * method to list disaster type
    */
    
    public function loadClass(){
       // dd('from services');
        $class = Classes::orderBy('displayOrder')->get();
        return $class;
    }

    /**
     * method to save class
     */
    public function saveClass(Request $request){
        
        //return($request['disasterName']);
        $id = $request->id;
        if( $id != null){
            $cla = [
                'class'                 => $request['className'],
                'code'                  => $request['code'],
                'description'           =>  $request['description'],
                'status'                => $request['status'],
                'updated_by'            =>$request['user_id'],
                'created_at'            =>date('Y-m-d h:i:s'),
            ];
            $data = Classes::find($request['id']);
            $messs_det='className:'.$data->name.'; description:'.$data->description.';code:'.$data->code.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','class','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $class = Classes::where('id', $id)->update($cla);
            return $this->successResponse($class, Response::HTTP_CREATED);
        }else{

            $cla = [
                'class'                 =>  $request['className'],
                'code'                  =>  $request['code'],
                'description'           =>  $request['description'],
                'status'                =>  $request['status'],
                'created_by'            =>  $request['user_id'],
                'created_at'            =>date('Y-m-d h:i:s'),
            ];
            //dd($cla);
            $class = Classes::create($cla);
            return $this->successResponse($class, Response::HTTP_CREATED);
        }
    }
}
