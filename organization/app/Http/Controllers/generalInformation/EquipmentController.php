<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\generalInformation\EquipmentAndFurniture;
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
        //
    }

    /**
     * method to list equipment and furniture
    */
    
    public function loadEquipment(){
        $equi = DB::table('equipment_and_furniture as a')
            ->join('equipment_type as b', 'a.type', '=', 'b.id')
            ->join('equipment_items as c', 'a.item', '=', 'c.id')
            ->join('equipment_usage as d', 'a.location', '=', 'd.id')
            ->select('b.name as type', 'c.equipmentItem as item','d.name as location','a.number as number')->get();
        return $equi;
    }

    /**
     * method to get type in dropdown
     */
    public function getType(){
        return EquipmentType::get(['id','name']);
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
        return EquipmentUsage::get(['id','name']);
    }

    /** 
     * method to save section
    */
    public function saveEquipmentAndFurniture(Request $request){
        $id = $request->id;
        if( $id != null){
            $sec = [
                'type'          => $request['type'],
                'item'        => $request['item'],
                'location'        => $request['location'],
                'number'        => $request['number'],
            ];
            $section = EquipmentAndFurniture::where('id', $id)->update($sec);
        }else{
            $sec = [
                'type'          => $request['type'],
                'item'        => $request['item'],
                'location'        => $request['location'],
                'number'        => $request['number'],
            ];
            $section = EquipmentAndFurniture::create($sec);

        }
        
        return $this->successResponse($section, Response::HTTP_CREATED);
}

}
