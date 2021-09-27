<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockIssued;
use App\Models\mess_manage\LocalProcure;
use App\Models\mess_manage\TransactionTable;
use Illuminate\Support\Facades\DB;
use Exception;

class StockIssuedController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
   
    public function saveStockIssued(Request $request){
        //  dd($request);
        $orgId = $request['organizationId'];
        $date = $request['dateOfissue'];
        $category = $request['category'];
        if( $category=='Central'){
            foreach ($request->itemList as $i=> $item){
                $rem="NA";
                if(isset($item['remarks'])){
                    $rem=$item['remarks'];
                }
                $quantity=0;
                if(isset($item['issue_qty'])){
                    $quantity=$item['issue_qty'];
                }
                $damagequantity=0;
                if(isset($item['damagequantity'])){
                    $damagequantity=$item['damagequantity'];
                }
                $itemIssued = array(
                    'organizationId'             =>  $orgId,
                    'dateOfissue'                =>  $date,
                    'item_id'                    =>  $item['id'],
                    'quantity'                   =>  $quantity,
                    'unit_id'                    =>  $item['Unit_id'],
                    'damagequantity'             =>  $damagequantity,
                    'remarks'                    =>  $rem,
                    'category'                   =>  $request['category'],
                    'created_by'                 =>  $request->user_id,
                    'created_at'                 =>  date('Y-m-d h:i:s')
                );
              //  dd($itemIssued);
                
                $itemiss = StockIssued::create($itemIssued);
                $checkitem=TransactionTable::where('item_id',$item['id'])->where('organizationId',$orgId)->where('procured_type', $request['category'])->first();
                $qty=$checkitem->available_qty-($quantity+$damagequantity);//$damagequantity,taken out as its contributing negative values in transaction
              //  dd($qty);
                $update_data=[
                    'available_qty' => $qty,
                    'updated_by'    => $request->user_id,
                    'updated_at'    =>  date('Y-m-d h:i:s'),
                ];
               // dd($update_data);
                TransactionTable::where('item_id',$item['id'])->where('procured_type','Central')->update($update_data);
            }
        }
        else{
            foreach ($request->item_issue as $i=> $item){
                $itm_id=explode('_',$item['item'])[0];
                $unitid=explode('_',$item['item'])[1];
                $quantity=0;
                if(isset($item['issue_qty'])){
                    $quantity=$item['issue_qty'];
                }
                $damagequantity=0;
                if(isset($item['damagequantity'])){
                    $damagequantity=$item['damagequantity'];
                }
                $rem="NA";
                    if(isset($item['remarks'])){
                        $rem=$item['remarks'];
                    }
                $itemIssued = array(
                    'organizationId'             =>  $orgId,
                    'dateOfissue'                =>  $date,
                    'item_id'                    =>  $itm_id,
                    'quantity'                   =>  $quantity,
                    'unit_id'                    =>  $unitid,
                    'damagequantity'             =>  $damagequantity,
                    'remarks'                    =>  $rem,
                    'category'                   =>  $request['category'],
                    'updated_by'                 =>  $request->user_id,
                    'created_at'                 =>  date('Y-m-d h:i:s')
            );
          //  dd($itemIssued);
            $itemiss = StockIssued::create($itemIssued);
            $checkitem=TransactionTable::where('item_id',$itm_id)
            ->where('organizationId', $orgId)->where('procured_type', $request['category'])->first();
            $qty=$checkitem->available_qty-($quantity+$damagequantity);
                $update_data=[
                    'available_qty' => $qty,
                    'updated_by'    => $request->user_id,
                    'updated_at'    =>  date('Y-m-d h:i:s'),
                ];
                //  dd($update_data);
                TransactionTable::where('item_id',$itm_id)->where('procured_type','Local')->update($update_data);
            }
           
        }
        
        return $this->successResponse($itemiss, Response::HTTP_CREATED);
        
    }
    // public function saveStockIssuedEdit(Request $request){
    //    //  dd($request);
    //     $id = $request->id;
    //     $orgId = $request['organizationId'];
    //     $date = $request['dateOfissue'];

    //     $itemIssued = array(
    //         'organizationId'             =>  $orgId,
    //         'dateOfissue'                =>  $date,
    //         'id'                         =>  $id,
    //         'item_id'                    =>  $request['item_id'],
    //         'unit_id'                    =>  $request['unit_id'],
    //         'quantity'                   =>  $request['quantity'],
    //         'damagequantity'             =>  $request['damagequantity'],
    //         'remarks'                    =>  $request['remarks'],
    //         'updated_by'                 =>  $request->user_id,
    //         'created_at'                 =>  date('Y-m-d h:i:s')
    //     );
    //   //  dd( $itemIssued);
      
    //     $itemiss = StockIssued::where('id',$id)->update($itemIssued);
    //  //   dd($itemiss);
    //     $checkitem=TransactionTable::where('item_id', $request['item_id'])->where('organizationId',$orgId)->first();
    //     $qty=$checkitem->available_qty-($request['quantity']);//$damagequantity,taken out as its contributing negative values in transaction
    //     $update_data=[
    //         'available_qty' => $qty,
    //         'updated_by'    => $request->user_id,
    //         'updated_at'    =>  date('Y-m-d h:i:s'),
    //     ];
      
    //     TransactionTable::where('item_id',$request['item_id'])->update($update_data);
      
    //  return $this->successResponse($itemiss, Response::HTTP_CREATED);
    
    // }

    public function saveStockIssuedEdit(Request $request){
     // dd($request);
        $current_stock_data=StockIssued::where('id', $request->id)->where('category',$request->category)->first();
      //  dd($current_stock_data);
        if($current_stock_data!=null && $current_stock_data!=""){
            $current_stock_qty=   $current_stock_data->quantity;
            $current_damage_qty = $current_stock_data->damagequantity;
            $request_qty=  $request->quantity;
            $request_dam_qty= $request->damagequantity;
            if($request_qty > $current_stock_qty || $request_dam_qty > $current_damage_qty){
                $qty_diff = $request_qty-$current_stock_qty;
                $dmage_diff = $request_dam_qty-$current_damage_qty;
                $qty_to_update_stock=  $current_stock_qty+ $qty_diff;
                $damage_update_qty= $current_damage_qty + $dmage_diff; 
                $stock_data=[
                    'quantity'       => $qty_to_update_stock,
                    'damagequantity' => $damage_update_qty,
                    'dateOfissue'    => $request->dateOfissue,
                    'remarks'        => $request->remarks
                ];
                $update_Issue= StockIssued::where('item_id', $current_stock_data->item_id)->where('category',$current_stock_data->category)->update($stock_data);
                $curr_tr_data=TransactionTable::where('organizationId',$current_stock_data->organizationId)
                ->where('item_id', $current_stock_data->item_id)->where('procured_type',$current_stock_data->category)->first();
                $stock_qty= $curr_tr_data->available_qty;
                $update_tr_qty=  ($stock_qty- $qty_diff)-$dmage_diff;
                
                $tr_data=[
                    'available_qty'  => $update_tr_qty,
                    'differenceqty'  => $qty_diff,
                    'updated_by'     => $request->user_id,
                    'updated_at'     =>  date('Y-m-d h:i:s'),
                ];
             //   dd($tr_data);
                $update_Issue= TransactionTable::where('item_id', $current_stock_data->item_id)->where('procured_type',$current_stock_data->category)->update($tr_data);
               
            }else{
                $qty_diff = $current_stock_qty -$request_qty;
                $dmage_diff = $request_dam_qty-$current_damage_qty;
                $qty_to_update_stock= $current_stock_qty-$qty_diff;
                $damage_update_qty= $current_damage_qty - $dmage_diff; 

                $stock_data=[
                    'quantity'       =>  $qty_to_update_stock,
                    'damagequantity' =>  $damage_update_qty,
                    'dateOfissue'    =>  $request->dateOfissue,
                    'remarks'        =>  $request->remarks
                ];
                $update_Issue= StockIssued::where('item_id', $current_stock_data->item_id)->where('category',$current_stock_data->category)->update($stock_data);
                $curr_tr_data=TransactionTable::where('organizationId',$current_stock_data->organizationId)
                ->where('item_id', $current_stock_data->item_id)->where('procured_type',$current_stock_data->category)->first();
                $stock_qty= $curr_tr_data->available_qty;
                $update_tr_qty=  ($stock_qty+ $qty_diff)-$dmage_diff;
                $tr_data=[
                    'available_qty' => $update_tr_qty,
                    'updated_by'    => $request->user_id,
                    'updated_at'    =>  date('Y-m-d h:i:s'),
                ];
              // dd( $tr_data);
                $update_Issue=TransactionTable::where('item_id', $current_stock_data->item_id)->where('procured_type',$current_stock_data->category)->update($tr_data);
            }
            
        }
        return $this->successResponse($update_Issue);
    }


    public function loadStockIssuedList($orgId=""){
            $list = DB::table('stock_issueds')
            ->select('id','organizationId', 'dateOfissue as dateOfissue','item_id as item','category', 'quantity as quantity','unit_id as unit')->where('organizationId',$orgId)->get();
            return $list;
    }

    public function getAvailableStocks($id="",$type=""){
        $response_data=TransactionTable::where('item_id',$id)->where('procured_type',$type)->first();
        return $response_data;
    }
    public function StockIssueEditList($lssId=""){
        //dd($lssId);
        $response_data=StockIssued::where('id', $lssId)->first();
      //  dd($response_data->item_id,TransactionTable::where('item_id',$response_data->item_id)->first());
        $response_data->availaleqty=TransactionTable::where('item_id',$response_data->item_id)
        ->where('procured_type',$response_data->category)
        ->first()->available_qty;
       // return $response_data->availaleqty;
        return $this->successResponse($response_data);
    }

  

    public function getquantity($itemId="", $chekva="", $orgId=""){

    //  dd( $orgId,$itemId,$chekva  );
      $response_data=TransactionTable::where('item_id', $itemId)
      ->where('procured_type',$chekva)
      ->where('organizationId',$orgId )->first();
    //  dd($response_data);
      return $this->successResponse($response_data);
    }

}
