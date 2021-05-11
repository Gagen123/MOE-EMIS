<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
//use App\Models\mess_manage\ItemReleasedNote; 
use Illuminate\Support\Facades\DB;

class StockReceivedController extends Controller
{    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function getFoodRelease($termId = ""){
        // return 'from service of mine';
      $list = DB::table('item_released_notes as a')
      ->join('food_releases as b')
      ->select( 'a.item as item','a.quantity as quantity')->get();
      return $list;
  }
}
