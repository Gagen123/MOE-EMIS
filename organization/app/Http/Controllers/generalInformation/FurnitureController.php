<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Furniture;
use App\Models\Masters\FurnitureType;
use App\Models\Masters\FurnitureItem;
use App\Models\Masters\FurnitureUsage;
use Illuminate\Support\Facades\DB;

class FurnitureController extends Controller
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
     * method to list Furniture and furniture
    */
    
    public function loadFurniture($orgId=""){

        $equip = DB::table('organization_furniture as a')
            ->join('master_furniture_type as b', 'a.type', '=', 'b.id')
            ->join('master_furniture_item as c', 'a.item', '=', 'c.id')
            ->join('master_furniture_usage as d', 'a.locationUse', '=', 'd.id')
            ->select('a.id as id','a.lifeExpectancy as lifeExpectancy','a.dateReceived as dateReceived', 'a.number as number', 'b.name as type', 
            'c.name as item','a.cost as cost', 'a.condition as condition','d.name as locationUse', 'b.id AS typeId', 'c.id AS itemId')->where('organizationId',$orgId)->get();

        return $equip;
    }

    /**
     * method to get type in dropdown
     */
    public function getFurnitureType(){
        return FurnitureType::where('status',1)->get();
    }

    /**
     * method to get item in dropdown by type
     */
    public function getFurnitureItem($typeId){
        return $this->successResponse(FurnitureItem::where ('furnitureTypeId',$typeId)->get());

    }

     /**
     * method to get location use in dropdown
     */
    public function getFurnitureUse(){
        return FurnitureUsage::where('status',1)->get();
    }

    /**
     * TO save Furnitures
     */

    public function saveFurniture(Request $request){

        $id = $request->id;

        if( $id != null){
            $data = [
                'organizationId'            =>  $request['organizationId'],
                'type'                      =>  $request['type'],
                'item'                      =>  $request['item'],
                'locationUse'               =>  $request['location'],
                'cost'                      =>  $request['cost'],
                'number'                    =>  $request['number'],
                'condition'                 =>  $request['condition'],
                'lifeExpectancy'            =>  $request['life_expectancy'],
                'dateReceived'              =>  $request['date_received'],
                'updated_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];

            $response_data = Furniture::where('id', $id)->update($data);
        } else {
            $data = [
                'organizationId'            =>  $request['organizationId'],
                'type'                      =>  $request['type'],
                'item'                      =>  $request['item'],
                'locationUse'               =>  $request['location'],
                'cost'                      =>  $request['cost'],
                'number'                    =>  $request['number'],
                'condition'                 =>  $request['condition'],
                'lifeExpectancy'            =>  $request['life_expectancy'],
                'dateReceived'              =>  $request['date_received'],
                'created_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];

            $response_data = Furniture::create($data);

        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /** 
     * method to save Furnitures
     * old function created by Ugyen
    */
    public function saveEquipmentAndFurniture(Request $request){
        $id = $request->id;
        if( $id != null){
            $sec = [
                'organizationId'        => $request['organizationId'],
                'type'                  => $request['type'],
                'item'                  => $request['item'],
                'location'              => $request['location'],
                'number'                => $request['number'],
                'updated_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];
            $section = EquipmentAndFurniture::where('id', $id)->update($sec);
        }else{
            $sec = [
                'organizationId'        => $request['organizationId'],
                'type'                  => $request['type'],
                'item'                  => $request['item'],
                'location'              => $request['location'],
                'number'                => $request['number'],
                'created_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];
            $section = EquipmentAndFurniture::create($sec);

        }
        
        return $this->successResponse($section, Response::HTTP_CREATED);
    }

}
