<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\EquipmentType;
use App\Models\Masters\EquipmentItem;
use App\Models\Masters\FurnitureType;
use App\Models\Masters\FurnitureItem;

use Illuminate\Support\Facades\DB;


class EquipmentItemController extends Controller
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
     * method to list equipment item
    */
    
    public function loadEquipmentItem(){
        $subCategory = DB::table('equipment_items as a')
            ->join('equipment_type as b', 'b.id', '=', 'a.equipmentType')
            ->select('a.id as id', 'a.equipmentItem as equipmentItem','b.name as equipmentType','b.id as equipmentTypeId',
            'a.description as description','a.status as status')->get();
            return $subCategory;
    }

    /** 
     * method to save or update equipment item 
    */
    public function saveEquipmentItem(Request $request){
        $id = $request->id;
        if( $id != null){
            $equ = [
                'equipmentItem'          => $request['equipmentItem'],
                'equipmentType'          => $request['equipmentType'],
                'description'            => $request['description'],
                'status'                 => $request['status'],
                'updated_by'             =>$request['user_id'],
                'created_at'             =>date('Y-m-d h:i:s'),
            ];

            $data = EquipmentItem::find($request['id']);

            $messs_det='equipmentItem:'.$data->name.'; equipmentType:'.$data->equipmentType.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','equipment_items','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");

            $equipment = EquipmentItem::where('id', $id)->update($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);

        }else{
            $equ = [
                'equipmentItem'          => $request['equipmentItem'],
                'equipmentType'          => $request['equipmentType'],
                'description'            => $request['description'],
                'status'                 => $request['status'],
                'created_by'             => $request['user_id'],
                'created_at'             => date('Y-m-d h:i:s'),
            ];
            $equipment= EquipmentItem::create($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }
    }
    /**
     * method to list location type
    */
    
    public function getEquipmentTypeDropdown(){
        return EquipmentType::get(['id','name']);
    }

    public function saveFurnitureItem(Request $request){
        $id = $request->id;
        if( $id != null){
            $furitem = [
                'name'                      => $request['name'],
                'furnitureType'             => $request['furnitureType'],
                'description'               => $request['description'],
                'status'                    => $request['status'],
                'updated_by'                =>$request['user_id'],
                'created_at'                =>date('Y-m-d h:i:s'),
            ];

           // $data = FurnitureItem::find($request['id']);

          //  $messs_det='name:'.$data->name.'; furnitureType:'.$data->furnitureType.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
          //  $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','furniture_items','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");

            $furniture = FurnitureItem::where('id', $id)->update($furitem);
          //  return $this->successResponse($furniture, Response::HTTP_CREATED);

        }else{
            $furitem = [
                'name'                   => $request['name'],
                'furnitureType'          => $request['furnitureType'],
                'description'            => $request['description'],
                'status'                 => $request['status'],
                'created_by'             => $request['user_id'],
                'created_at'             => date('Y-m-d h:i:s'),
            ];
            $furniture= FurnitureItem::create($furitem);
            return $this->successResponse($furniture, Response::HTTP_CREATED);
        }
    }
    public function getFurnitureTypeDropdown(){
       // dd('from services');
        return FurnitureType::get(['id','name']);
    }

    public function loadFurnitureItem(){
      //  dd('from microservices');
        $subCategory = DB::table('master_furniture_item as a')
        ->join('master_furniture_type as b', 'a.furnitureType', '=', 'b.id')
        ->select('a.id as id', 'a.name as name','b.name as furnitureType',
        'a.description as description','a.status as status')->get();
        return $subCategory;
    }
    // public function loadEquipmentItem(){
    //     $subCategory = DB::table('equipment_items as a')
    //         ->join('equipment_type as b', 'b.id', '=', 'a.equipmentType')
    //         ->select('a.id as id', 'a.equipmentItem as equipmentItem','b.name as equipmentType','b.id as equipmentTypeId',
    //         'a.description as description','a.status as status')->get();
    //         return $subCategory;
    // }

}
