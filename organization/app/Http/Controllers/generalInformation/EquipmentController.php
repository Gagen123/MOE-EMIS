<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Equipment;
use App\Models\Masters\EquipmentType;
use App\Models\Masters\EquipmentItem;
use App\Models\Masters\EquipmentUsage;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
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
     * method to list equipment and furniture
    */
    
    public function loadEquipment($orgId=""){
      //  dd('from services');
        $equip = DB::table('organization_equipment as a')
            ->join('equipment_type as b', 'a.type', '=', 'b.id')
            ->join('equipment_items as c', 'a.item', '=', 'c.id')
            ->select('a.id as id','b.name as type', 'c.equipmentItem as item','a.usable as usable', 'a.notusable as notusable'
           )->where('organizationId',$orgId)->get();

        return $equip;
    }

    /**
     * method to get type in dropdown
     */
    public function getType(){
        return EquipmentType::where('status',1)->get();
    }

    /**
     * method to get item in dropdown by type
     */
    public function getItem($typeId){
        return $this->successResponse(EquipmentItem::where ('equipmentType',$typeId)->get());

    }

     /**
     * method to get location use in dropdown
     */
    public function getLocationUse(){
        return EquipmentUsage::where('status',1)->get();
    }

    /**
     * TO save Equipments
     */

    public function saveEquipment(Request $request){
        $id = $request->id;
        if( $id != null){
            $data = [
                'organizationId'            =>  $request['organizationId'],
                'type'                      =>  $request['type'],
                'item'                      =>  $request['item'],
                'usable'                    =>  $request['usable'],
                'notusable'                 =>  $request['notusable'],
                'updated_by'                =>  $request->user_id,
                'id'                        =>   $request->id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];

            $response_data = Equipment::where('id', $id)->update($data);
        } else {
            $data = [
                'organizationId'            =>  $request['organizationId'],
                'type'                      =>  $request['type'],
                'item'                      =>  $request['item'],
                'usable'                    =>  $request['usable'],
                'notusable'                 =>  $request['notusable'],
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];
          //   dd($data);
             $response_data = Equipment::create($data);
        // try{
          
        // }catch(\Illuminate\Database\QueryException $ex){
        //    dd($ex);
        //     }
            

        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /** 
     * method to save equipments
     * old function created by Ugyen
    */
    // public function saveEquipmentAndFurniture(Request $request){
    //     $id = $request->id;
    //     if( $id != null){
    //         $sec = [
    //             'organizationId'        => $request['organizationId'],
    //             'type'                  => $request['type'],
    //             'item'                  => $request['item'],
    //             'location'              => $request['location'],
    //             'number'                => $request['number'],
    //             'updated_by'            =>  $request->user_id,
    //             'created_at'            =>  date('Y-m-d h:i:s')
    //         ];
    //         $section = EquipmentAndFurniture::where('id', $id)->update($sec);
    //     }else{
    //         $sec = [
    //             'organizationId'        => $request['organizationId'],
    //             'type'                  => $request['type'],
    //             'item'                  => $request['item'],
    //             'location'              => $request['location'],
    //             'number'                => $request['number'],
    //             'created_by'            =>  $request->user_id,
    //             'created_at'            =>  date('Y-m-d h:i:s')
    //         ];
    //         $section = EquipmentAndFurniture::create($sec);

    //     }
        
    //     return $this->successResponse($section, Response::HTTP_CREATED);
    // }

    public function getEquipmentDetails($equId=""){
        $response_data=Equipment::where('id',$equId)->first();
     // $response_data->facility=FacilityInStructure::where('infrastructureId',$response_data->id)->get();
        return $this->successResponse($response_data);
    }

    
}
