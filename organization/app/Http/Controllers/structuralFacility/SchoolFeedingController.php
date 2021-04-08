<?php

namespace App\Http\Controllers\structuralFacility;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\structuralFacility\SchoolFeeding;


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
    public function saveKitchenStatus(Request $request){

        $kitchenStatus = $request->kitchen_status;

            foreach ($kitchenStatus as $ks){
                $kitchenStatus =[
                    'organizationId'    =>  1,
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
        return $this->successResponse($kitchen, Response::HTTP_CREATED);
    }

    /**
     * method to load kitchen status details
     */
    public function loadKitchenStatus($user_id=""){
        return $this->successResponse(SchoolFeeding::where('created_by',$user_id)->where('status','Pending')->get());
    }
}
