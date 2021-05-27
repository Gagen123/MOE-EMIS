<?php

namespace App\Http\Controllers\messManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\FoodRelease;
use App\Models\mess_manage\ItemReleasedNote; 
use Illuminate\Support\Facades\DB;

class FoodReleasedController extends Controller
{
    //
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveFoodRelease(Request $request){

        $foodreleased = [
            'dateOfrelease'             =>  $request['dateOfrelease'],
            'dzongkhag_id'              =>  $request['dzongkhag'],
            'org_id'                    =>  $request['organizaiton'],
            'term_id'                   =>  $request['term'],
            'remarks'                   =>  $request['remarks'],
            'updated_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s')

        ];
        $foodrel = FoodRelease::create($foodreleased);
        foreach ($request->items_released as $i => $item){
            $itemreleasenote = array(
                'foodreleaseId'              =>  $foodrel->id,
                'item_id'                    =>  $item['item'],
                'quantity'                   =>  $item['quantity'],
                'unit_id'                    =>  $item['unit'],
                'remark'                     =>  $item['remarks'],
                'updated_by'                 =>  $request->user_id,
                'created_at'                 =>  date('Y-m-d h:i:s')
            );
            ItemReleasedNote::create($itemreleasenote);
          //  dd($foodrel);
        }
        return $this->successResponse($foodrel, Response::HTTP_CREATED);
    }
}
