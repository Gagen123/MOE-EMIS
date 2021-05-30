<?php

namespace App\Http\Controllers\structuralFacility;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\structuralFacility\SchoolFeeding;
use Illuminate\Support\Facades\DB;

class SchoolFeedingController extends Controller
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
     * method to save kitchen status details in draft
     */
    public function saveKitchenStatus(Request $request){

        $kitchenStatus = $request->kitchen_status;
        $status = $request->status;

        if($status == "pending"){
            DB::table('school_feedings')->where('type', 1)->delete();

            foreach ($kitchenStatus as $ks){
                $kitchenStatus =[
                    'organizationId'    =>  $request['organizationId'],
                    'description'       =>  $ks['question'],
                    'value'             =>  $ks['value'],
                    'status'            =>  $request['status'],
                    'type'              =>  1,
                    'id'                =>  $request['id'],
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
                ];
                $kitchen = SchoolFeeding::create($kitchenStatus);
            }
        }else{
            foreach ($kitchenStatus as $ks){
                $kitchenStatus =[
                    'organizationId'    =>  $request['organizationId'],
                    'description'       =>  $ks['question'],
                    'value'             =>  $ks['value'],
                    'status'            =>  $request['status'],
                    'type'              =>  1,
                    'id'                =>  $request['id'],
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
                ];
                $kitchen = SchoolFeeding::create($kitchenStatus);
            }
        }
            
        return $this->successResponse($kitchen, Response::HTTP_CREATED);
    }

    /**
     * method to load kitchen status details
     */
    public function loadKitchenStatus($user_id=""){
        return $this->successResponse(SchoolFeeding::where('created_by',$user_id)->where('status','Pending')->where('type',1)->get());
    }

    /**
     * method to save food store status in draft
     */
    public function saveFoodStoreStatus(Request $request){

        $FoodStoreStatus = $request->food_status;
        $status = $request->status;

        if($status == "pending"){
            DB::table('school_feedings')->where('type', 2)->delete();

            foreach ($FoodStoreStatus as $ks){
                $foodStatus =[
                    'organizationId'    =>  $request['organizationId'],
                    'description'       =>  $ks['question'],
                    'value'             =>  $ks['value'],
                    'status'            =>  $request['status'],
                    'type'              =>  2,
                    'id'                =>  $request['id'],
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
                ];
                $food = SchoolFeeding::create($foodStatus);
            }
        }else{
            foreach ($FoodStoreStatus as $ks){
                $foodStatus =[
                    'organizationId'    =>  $request['organizationId'],
                    'description'       =>  $ks['question'],
                    'value'             =>  $ks['value'],
                    'status'            =>  $request['status'],
                    'type'              =>  2,
                    'id'                =>  $request['id'],
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
                ];
                $food = SchoolFeeding::create($foodStatus);
            }
        }
            
        return $this->successResponse($food, Response::HTTP_CREATED);
    }

    /**
     * method to save equipment and utensil in kitchen tab in draft
     */
    public function saveUtensilKitchen(Request $request){

        $utensilKitchen = $request->equipment_kitchen;
        $status = $request->status;

        if($status == "pending"){
            DB::table('school_feedings')->where('type', 3)->delete();

            foreach ($utensilKitchen as $ks){
                $utensil =[
                    'organizationId'    =>  $request['organizationId'],
                    'description'       =>  $ks['question'],
                    'value'             =>  $ks['value'],
                    'status'            =>  $request['status'],
                    'type'              =>  3,
                    'id'                =>  $request['id'],
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
                ];
                $kitchen = SchoolFeeding::create($utensil);
            }
        }else{
            foreach ($utensilKitchen as $ks){
                $utensil =[
                    'organizationId'    =>  $request['organizationId'],
                    'description'       =>  $ks['question'],
                    'value'             =>  $ks['value'],
                    'status'            =>  $request['status'],
                    'type'              =>  3,
                    'id'                =>  $request['id'],
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
                ];
                $kitchen = SchoolFeeding::create($utensil);
            }
        }
            
        return $this->successResponse($kitchen, Response::HTTP_CREATED);
    }

    /**
     * method to save dinning hall details 
     */
    public function saveDinningHall(Request $request){

        $dinningHall = $request->dinning_hall;
        $status = $request->status;

            foreach ($dinningHall as $ks){
                $utensil =[
                    'organizationId'    =>  $request['organizationId'],
                    'description'       =>  $ks['question'],
                    'value'             =>  $ks['value'],
                    'status'            =>  $request['status'],
                    'type'              =>  4,
                    'id'                =>  $request['id'],
                    'created_by'        =>  $request->user_id,
                    'created_at'        =>  date('Y-m-d h:i:s')
                ];
                $kitchen = SchoolFeeding::create($utensil);
            }

            $array = ['status' => $request->status];
            $pendingList = DB::table('school_feedings as a')->select('a.status as status')
                          ->where('created_by',$request->user_id)
                          ->where('status', 'pending')->get();

            foreach($pendingList as $ps){
                DB::table('school_feedings')->update($array);
            }
        return $this->successResponse($kitchen, Response::HTTP_CREATED);
    }

     /**
     * method to load food store status details
     */
    public function loadFoodStoreStatus($user_id=""){
        return $this->successResponse(SchoolFeeding::where('created_by',$user_id)->where('status','Pending')->where('type',2)->get());
    }

    /**
     * method to load utensil kitchen details
     */
    public function loadUtensilKitchenStatus($user_id=""){
        return $this->successResponse(SchoolFeeding::where('created_by',$user_id)->where('status','Pending')->where('type',3)->get());
    }
}
