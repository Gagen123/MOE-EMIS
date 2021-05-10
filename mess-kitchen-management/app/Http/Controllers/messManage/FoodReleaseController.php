<?php

namespace App\Http\Controllers\messManage;
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
        // dd('m here');
        $foodrelease = [
            'dateOfrelease'                      =>  $request['dateOfrelease'],
            'dzongkhag'                 =>  $request['dzongkhag'],
            'school'                    =>  $request['school'],
            'quarter'                   =>  $request['quarter'],
            'updated_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s')
        ];
        $foodrel = FoodRelease::create($foodrelease);
        foreach ($request->items_released as $i=> $item){
            $itemreleasednote = array(
                'foodreleaseId'              =>  $foodrel->id,
                'item'                       =>  $item['item'],
                'quantity'                   =>  $item['quantity'],
                'unit'                       =>  $item['unit'],
                'remark'                     =>  $item['remarks'],
                'updated_by'                 =>  $request->user_id,
                'created_at'                 =>  date('Y-m-d h:i:s')
            );
            // dd('m here');
            $foodrel = ItemReleasedNote::create($itemreleasednote);
           // dd('m here');
        }
        return $this->successResponse($foodrel, Response::HTTP_CREATED);
    }
    public function loadFoodReleaseList(){
          // return 'from service of mine';
        $list = DB::table('food_releases')
        ->select( 'dateOfrelease as Date',
         'dzongkhag','school',
         'quarter'
         )->get();
        return $list;
    }
}


