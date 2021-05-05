<?php

namespace App\Http\Controllers\mess_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\FoodRelease;
use App\Models\mess_manage\ItemReleasedNote; 
use Illuminate\Support\Facades\DB;

class FoodReleaseController extends Controller
{
    //
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveFoodRelease(Request $request){
        $id = $request->id;

        if($id != null){
            $foodrelease = [
                'organizationId'            =>  $request['organizationId'],
                'date'                      =>  $request['date'],
                'dzongkhag'                 =>  $request['dzongkhag'],
                'school'                    =>  $request['school'],
                'quarter'                   =>  $request['quarter'],
                'updated_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
                ];
                $fodrel = FoodRelease::where('id', $id)->update($foodrelease);
                DB::table('item_released_notes')->where('foodreleaseId', $request->id)->delete();
                foreach ($request->input('users') as $i=> $user){
                    $itemreleasenote = array(
                        'foodreleaseId'            =>  $request->id,
                        'item'                     =>  $user['item'],
                        'quantity'                 =>  $user['quantity'],
                        'unit'                     =>  $user['unit'],
                        'remark'                   =>  $user['remark'],
                        'updated_by'               =>  $request->user_id,
                        'created_at'               =>  date('Y-m-d h:i:s')
                    );
                    $fodrel = ItemReleasedNote::create($itemreleasenote);
                }
            return $this->successResponse($fodrel, Response::HTTP_CREATED);

        }else{
            $foodrelease = [
                'organizationId'            =>  $request['organizationId'],
                'date'                      =>  $request['date'],
                'dzongkhag'                 =>  $request['dzongkhag'],
                'school'                    =>  $request['school'],
                'quarter'                   =>  $request['quarter'],
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
                ];
                
                $fodrel = FoodRelease::create($foodrelease);
                $foodreleaseId = DB::table('food_releases')->orderBy('id','desc')->limit(1)->pluck('id');
    
                foreach ($request->input('users') as $i=> $user){
                    $itemreleasenote = array(
                        'foodreleaseId'              =>  $foodreleaseId[0],
                        'item'                       =>  $user['item'],
                        'quantity'                   =>  $user['quantity'],
                        'unit'                       =>  $user['unit'],
                        'remarks'                    =>  $user['remarks'],
                        'created_by'                 =>  $request->user_id,
                        'created_at'                 =>  date('Y-m-d h:i:s')
                );
                    $fodrel = ItemReleasedNote::create($itemreleasenote);
                }
            return $this->successResponse($fodrel, Response::HTTP_CREATED);
        }
    }

    public function loadFoodReleaseList($orgId=""){
        $list = DB::table('food_releases')
        ->select( 'date as Date of Screening',
            'Dzongkhag','School',
             'Quater'
            )->get();
        return $list;
    }

    public function getFoodReleseDetails($fodrelId=""){
        $response_data=FoodRelease::where('id',$fodrelId)->first();
        $response_data->itemrelease=ItemReleasedNote::where('foodreleaseId',$response_data->id)->get();
        return $this->successResponse($response_data); 
    }
}


