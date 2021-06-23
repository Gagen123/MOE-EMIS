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
            ->select('a.id as id','b.name as type','c.name as item','a.usable as usable', 'a.notusable as notusable')
            ->where('organizationId',$orgId)->get();

        return $equip;
    }
   

    /**
     * method to get type in dropdown
     */
    public function getFurnitureType(){
      //  dd('m here at microservice');
        return FurnitureType::where('status',1)->get();
    }

    /**
     * method to get item in dropdown by type
     */ 
    public function getFurnitureItem($typeId){ 
       // dd('form services');
        return $this->successResponse(FurnitureItem::where ('furnitureType',$typeId)->get());

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
       // dd($id);
        $id = $request->id;
        if( $id != null){
            $data = [
                'organizationId'            =>  $request['organizationId'],
                'type'                      =>  $request['type'],
                'item'                      =>  $request['item'],
                'usable'                    =>  $request['usable'],
                'notusable'                 =>  $request['notusable'],
                'id'                        =>   $request->id,
                'updated_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];

            $response_data = Furniture::where('id', $id)->update($data);
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
           // dd($data);
            // try{
            $response_data = Furniture::create($data);
            // }
            // catch(\Illuminate\Database\QueryException $ex){
            //     dd($ex);
            //      }

        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getFurnitureDetails($furId=""){
       // dd($furId);
        $response_data=Furniture::where('id', $furId)->first();
        return $this->successResponse($response_data);
    }

   

    /** 
     * method to save Furnitures
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

    
}
