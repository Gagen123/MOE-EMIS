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
            'dateOfrelease'             =>  $request['dateOfrelease'],
            'dzongkhag'                 =>  $request['dzongkhag'],
            'school'                    =>  $request['school'],
            'quarter'                   =>  $request['quarter'],
            'updated_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s')
        ];
        $foodrel = FoodRelease::create($foodrelease);

        $releasId = DB::table('food_releases')->orderBy('id','desc')->limit(1)->pluck('id');

        foreach ($request->items_released as $i => $item){
            $itemreleasednote = array(
                'foodreleaseId'              =>  $releasId[0],
                'item'                       =>  $item['item'],
                'quantity'                   =>  $item['quantity'],
                'unit'                       =>  $item['unit'],
                'remark'                     =>  $item['remarks'],
                'updated_by'                 =>  $request->user_id,
                'created_at'                 =>  date('Y-m-d h:i:s')
            );
            $foodrel = ItemReleasedNote::create($itemreleasednote);
        }
        return $this->successResponse($foodrel, Response::HTTP_CREATED);
    }
    public function loadFoodReleaseList(){
          // return 'from service of mine';
        $list = DB::table('food_releases as a')
        ->select( 'a.dateOfrelease as dateOfrelease',
         'a.dzongkhag','a.school',
         'a.quarter', 'a.id'
         )->get();
        return $list;
    }

    public function getFoodReleaseItem($foodreleaseId=''){
      $list = DB::table('item_released_notes')
      ->select( 'item','quantity','unit')->where('foodreleaseId',$foodreleaseId)->get();
      return $list;
    }
}