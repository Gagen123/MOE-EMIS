<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\StructureCategory;
use App\Models\Masters\StructureSubCategory;
use App\Models\Masters\ECCDStructureType;
use App\Models\Masters\ECCDFacilities;
use Illuminate\Support\Facades\DB;


class StructureSubCategoryController extends Controller
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
     * method to list structure sub category type
    */
    
    public function loadStrSubCategory(){
        $subCategory = DB::table('structure_sub_categories as a')
            ->join('structure_category as b', 'b.id', '=', 'a.structureCategory')
            ->select('a.id as id', 'b.name as structureCategory','b.id as structureCategoryId',
            'a.structureCategory as structureID','a.subCategoryName as subCategoryName',
            'a.description as description','a.status as status')->get();
        return $subCategory;
    }

    /** 
     * method to save or update level type
    */
    public function saveStrSubCategory(Request $request){
        $id = $request->id;
        if( $id != null){
            $equ = [
                'structureCategory'          => $request['structureCategory'],
                'subCategoryName'          => $request['subCategoryName'],
                'description'          => $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
            $data = StructureSubCategory::find($request['id']);

            $messs_det='structureCategory:'.$data->structureCategory.'; subCategoryName:'.$data->subCategoryName.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','structure_sub_categories','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            
            $equipment = StructureSubCategory::where('id', $id)->update($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);

        }else{
            $equ = [
                'structureCategory'          => $request['structureCategory'],
                'subCategoryName'          => $request['subCategoryName'],
                'description'          => $request['description'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
            $equipment= StructureSubCategory::create($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }
    }

    /**
     * method to list location type
    */
    
    public function getStrCategoryDropdown(){
        return StructureCategory::get(['id','name']);
    }

    public function saveEccdFacility(Request $request){
        $id = $request->id;
        if( $id != null){
            $equ = [
                'id'                         => $request['id'],
                'faciltytype'                => $request['faciltytype'],
                'structuretype'              => $request['structuretype'],
                'description'                => $request['description'],
                'status'                     => $request['status'],
                'updated_by'                 => $request['user_id'],
                'created_at'                 => date('Y-m-d h:i:s'),
            ];
          //  $data = ECCDFacilities::find($request['id']);

         //   $messs_det='structureCategory:'.$data->structureCategory.'; subCategoryName:'.$data->subCategoryName.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
          //  $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','structure_sub_categories','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            
            $equipment = ECCDFacilities::where('id', $id)->update($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);

        }else{
            $equ = [
                'id'                         => $request['id'],
                'faciltytype'                => $request['faciltytype'],
                'structuretype'              => $request['structuretype'],
                'description'                => $request['description'],
                'status'                     => $request['status'],
                'created_by'                 =>$request['user_id'],
                'created_at'                 =>date('Y-m-d h:i:s'),
            ];
           // dd($equ);
            $equipment= ECCDFacilities::create($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }
    }
    public function getEccdStructureType(){
      //  dd('m here at services');
        return ECCDStructureType::get(['id','name']);
    }
    public function loadEccdFacilityList(){
        $subCategory = DB::table('master_eccdFacilities_type as a')
            ->join('master_eccdStructure_type as b', 'b.id', '=', 'a.structuretype')
            ->select('a.id as id', 'a.faciltytype as faciltytype','b.name as structuretype',
            'a.description as description','a.status as status')->get();
        return $subCategory;
    }
}
