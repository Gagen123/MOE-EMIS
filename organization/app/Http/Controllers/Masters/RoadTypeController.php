<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\RoadType;
use Illuminate\Support\Facades\DB;

class RoadTypeController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update disaster type
    */
    public function saveRoadType(Request $request){

        $id = $request->id;

        if( $id != null){
            $loc = [
                'name'          => $request['roadType'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = RoadType::find($request['id']);

            $messs_det='roadType:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','road_types','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            
            $location = RoadType::where('id', $id)->update($loc);
            return $this->successResponse($location, Response::HTTP_CREATED);
        }else{

            $loc = [
                'name'          => $request['roadType'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $location = RoadType::create($loc);
            return $this->successResponse($location, Response::HTTP_CREATED);
        }
    }

     /**
     * method to list disaster type
    */
    
    public function loadRoadType(){
        $loadRoadType = RoadType::all();
        return $loadRoadType;
    }
}
