<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockIssued;
use Illuminate\Support\Facades\DB;
use Exception;

class StockIssuedController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    // public function saveStockIssued(Request $request){
        // foreach($request->item_issue as $item){
        //     $item['dateOfissue'] = $request['dateOfissue'];
        //     $item["organizationId"] = $request['organizationId'];
        //     // $item["item"] = $request['item_id'];
        //     // $item["quantity"] = $request['quantity'];
        //     // $item["unit"] = $request['unit_id'];
        //     // $item["damagequantity"] = $request['damagequantity'];
        //     // $item["remarks"] = $request['remarks'];
        //     $item["created_by"] = $request["user_id"];
        //     $item["created_at"] = date('Y-m-d h:i:s');

        // //     $stockissue = array(
        // //      'organizationId'            =>  $orgId,
        // //      'dateOfissue'               =>  $request['dateOfissue'];
             
        // //      'item'                      =>  $item['item'],
        // //      'quantity'                  =>  $item['quantity'],
        // //      'unit'                      =>  $item['unit'],
        // //      'damagequantity'            =>  $item['damagequantity'],
        // //      'remarks'                   =>  $item['remarks'],
        // //      'updated_by'                =>  $request->user_id,
        // //      'created_at'                =>  date('Y-m-d h:i:s')


        // //     );
        // dd($item);
        //  $stckiss = StockIssued::create($item);
        //   // dd('stockissue');
        // }
        //  //  dd('m here'); 
              //  dd('m here');
    //     $orgId = $request['organizationId'];
    //     $date = $request['dateOfissue'];
    //  foreach ($request->item_issue as $i=> $item){
    //         $itemIssued = array(
    //          'organizationId'             =>  $orgId,
    //          'dateOfissue'                =>  $date,
    //          'item_id'                    =>  $item['item'],
    //          'quantity'                   =>  $item['quantity'],
    //          'unit_id'                    =>  $item['unit'],
    //          'damagequantity'             =>  $item['damagequantity'],
    //          'remarks'                    =>  $item['remarks'],
    //          'updated_by'                 =>  $request->user_id,
    //          'created_at'                 =>  date('Y-m-d h:i:s')
    //         );

    //      $itemiss = StockIssued::create($itemIssued);
    //     }
    //   //  dd('m here');
    //  //    dd('localprocure'); 
    //     return $this->successResponse($itemiss, Response::HTTP_CREATED);  
    //    // return $this->successResponse($item, Response::HTTP_CREATED);
    // }

    public function saveStockIssued(Request $request){
        $id = $request->id;
        if($id != null){
          DB::table('stock_issueds')->where('id', $request->id)->delete();
          foreach ($request->item_issue as $i=> $item){
              $itemIssued = array(
               'organizationId'             =>  $request->organizationId,
               'dateOfissue'                =>  $request->dateOfissue,
               'id'                         =>  $request->id,
               'item_id'                    =>  $item['item'],
               'quantity'                   =>  $item['quantity'],
               'unit_id'                    =>  $item['unit'],
               'damagequantity'             =>  $item['damagequantity'],
               'remarks'                    =>  $item['remarks'],
               'updated_by'                 =>  $request->user_id,
               'created_at'                 =>  date('Y-m-d h:i:s')
              );
  
              $itemiss = StockIssued::create($itemIssued);
            }
           return $this->successResponse($itemiss,Response::HTTP_CREATED);
          }else {
        //  dd($request);
          $orgId = $request['organizationId'];
          $date = $request['dateOfissue'];
          foreach ($request->item_issue as $i=> $item){
              $itemIssued = array(
               'organizationId'             =>  $orgId,
               'dateOfissue'                =>  $date,
               'item_id'                    =>  $item['item'],
               'quantity'                   =>  $item['quantity'],
               'unit_id'                    =>  $item['unit'],
               'damagequantity'             =>  $item['damagequantity'],
               'remarks'                    =>  $item['remarks'],
               'updated_by'                 =>  $request->user_id,
               'created_at'                 =>  date('Y-m-d h:i:s')
              );
  
           $itemiss = StockIssued::create($itemIssued);
          }
        //  dd('m here');
        //s   dd('itemIssued'); 
        return $this->successResponse($itemiss, Response::HTTP_CREATED);  
      }
    }
    public function loadStockIssuedList($orgId=""){
            $list = DB::table('stock_issueds')
            ->select('id','organizationId', 'dateOfissue as dateOfissue','item_id as item', 'quantity as quantity','unit_id as unit')->where('organizationId',$orgId)->get();
            return $list;
    }
    public function StockIssueEditList($lssId=""){
        //dd($lssId);
        $response_data=StockIssued::where('id', $lssId)->get();
        return $this->successResponse($response_data);
    }
}
