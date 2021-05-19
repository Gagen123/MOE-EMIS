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
         //dd('m here');
        $foodrelease = [
            'dateOfrelease'             =>  $request['dateOfrelease'],
            'dzongkhag_id'              =>  $request['dzongkhag'],
            'org_id'                    =>  $request['organizaiton'],
            'term_id'                   =>  $request['term'],
            'updated_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s')
        ];

        $foodrel = FoodRelease::create($foodrelease);

       // $releasId = DB::table('food_releases')->orderBy('id','desc')->limit(1)->pluck('id');
        // dd($request->items_release);
        foreach ($request->items_released as $i => $item){
            $itemreleasednote = array(
              //  'foodreleaseId'              =>  $releasId[0], 
                'foodreleaseId'              =>  $foodrel->id,
                'item_id'                    =>  $item['item'],
                'quantity'                   =>  $item['quantity'],
                'unit_id'                    =>  $item['unit'],
                'remark'                     =>  $item['remarks'],
                'updated_by'                 =>  $request->user_id,
                'created_at'                 =>  date('Y-m-d h:i:s')
            );
            ItemReleasedNote::create($itemreleasednote);
        }
        return $this->successResponse($foodrel, Response::HTTP_CREATED);
       // return($foodrel);
    }
    public function loadFoodReleaseList(){
        //   return 'from service of mine';
        $list = DB::table('food_releases')
        ->select( 'dateOfrelease as dateOfrelease',
         'dzongkhag_id as dzongkhag','org_id as organization',
         'term_id as term','id'
         )->get();
        return $list;
    }

    public function getFoodReleaseItem($foodreleaseId=''){
      $list = DB::table('item_released_notes')
      ->select( 'item','quantity','unit')->where('foodreleaseId',$foodreleaseId)->get();
      return $list;
    }
}