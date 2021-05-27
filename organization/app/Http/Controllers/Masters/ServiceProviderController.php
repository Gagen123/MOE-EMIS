<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\ServiceProvider;
use Illuminate\Support\Facades\DB;

class ServiceProviderController extends Controller
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
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }

    /** 
     * method to save or update disaster type
    */
    public function saveServiceProvider(Request $request){
        $id = $request->id;

        if( $id != null){
            $loc = [
                'serviceType'          => $request['serviceType'],
                'name'                 => $request['serviceName'],
                'description'          => $request['description'],
                'status'               => $request['status'],
                'updated_by'           =>$request['user_id'],
                'created_at'           =>date('Y-m-d h:i:s'),
            ];

            $data = ServiceProvider::find($request['id']);

            $messs_det='serviceType:'.$data->serviceType.'; name:'.$data->serviceName.';description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','service_providers','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            
            $location = ServiceProvider::where('id', $id)->update($loc);
            return $this->successResponse($location, Response::HTTP_CREATED);
        }else{

            $loc = [
                'serviceType'          => $request['serviceType'],
                'name'                 => $request['serviceName'],
                'description'          => $request['description']
                'status'               => $request['status'],
                'created_by'           =>$request['user_id'],
                'created_at'           =>date('Y-m-d h:i:s'),
            ];

            $location = ServiceProvider::create($loc);
            return $this->successResponse($location, Response::HTTP_CREATED);
        }
    }

     /**
     * method to list disaster type
    */
    
    public function loadServiceProvider(){
        $loadServiceProvider = ServiceProvider::all();
        return $loadServiceProvider;
    }
}
