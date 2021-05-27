<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\Level;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    use ApiResponser;
    public $audit_database;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->audit_database = config('services.constant.auditdb');
    }

    /**
     * method to list level type
    */
    
    public function loadLevel(){
        $level = Level::all();
        return $level;
        // return $this->successResponse($location);
    }

    /** 
     * method to save or update level type
    */
    public function saveLevel(Request $request){

        $id = $request->id;
        if( $id != null){
            $lev = [
                'name'          => $request['levelName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = Level::find($request['id']);

            //audit trail
            $messs_det='levelName:'.$data->name.'; description:'.$data->description.';status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','level','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");

            $level = Level::where('id', $id)->update($lev);
            return $this->successResponse($level, Response::HTTP_CREATED);
        }else{
            $lev = [
                'name'          => $request['levelName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $level = Level::create($lev);
            return $this->successResponse($level, Response::HTTP_CREATED);
        }
    }
}
