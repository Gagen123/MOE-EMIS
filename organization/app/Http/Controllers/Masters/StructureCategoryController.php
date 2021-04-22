<?php

namespace App\Http\Controllers\Masters;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\StructureCategory;
use Illuminate\Support\Facades\DB;

class StructureCategoryController extends Controller
{
    use ApiResponser;
    public $audit_database;
    //
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
     * method to list structure category
    */
    
    public function loadStructureCategory(){
        $str = StructureCategory::all();
        return $str;
    }

    /** 
     * method to save or update structure category
    */
    public function saveStructureCategory(Request $request){
        $id = $request->id;
        if( $id != null){
            $cat = [
                'name'          => $request['structureCategoryName'],
                'description'          => $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
            $data = StructureCategory::find($request['id']);

            $messs_det='structureCategoryName:'.$data->name.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','structure_category','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            
            $structureCategory = StructureCategory::where('id', $id)->update($cat);
            return $this->successResponse($structureCategory, Response::HTTP_CREATED);
        }else{

            $cat = [
                'name'          => $request['structureCategoryName'],
                'description'          => $request['description'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $structureCategory = StructureCategory::create($cat);
            return $this->successResponse($structureCategory, Response::HTTP_CREATED);
        }
    }
}
