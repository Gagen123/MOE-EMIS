<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\FoodRelease;
use App\Models\mess_manage\ItemReleasedNote;
use App\Models\mess_manage\FoodReleaseDocuments;
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
         $id = $request->id;
         if($id != null){
            $foodrelease = [
                'dateOfrelease'             =>  $request['dateOfrelease'],
                'dzongkhag_id'              =>  $request['dzongkhag'],
                'org_id'                    =>  $request['organizaiton'],
                'quarter_id'                =>  $request['quarter'],
                'remarks'                   =>  $request['remarks'],
                'id'                        =>  $request['id'],
                'updated_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];
           // dd($foodrelease);
            $foodrel = FoodRelease::where('id',$id)->update($foodrelease);
            $attachmentId =  $foodrel->id;
            if($request->attachment_details!=null && $request->attachment_details!="" && $request->attachmentId!=""){
                foreach($request->attachment_details as $att){
                    $attach =[
                        'attachmentId'              =>  $attachmentId,
                        'path'                      =>  $att['path'],
                        'attachment_for'            =>  'Food Release Note',
                        'user_defined_name'         =>  $att['user_defined_name'],
                        'original_name'             =>  $att['original_name'],

                    ];
                   // dd($attach);
                    FoodReleaseDocuments::create($attach);
                }
            }
            return $this->successResponse($foodrel, Response::HTTP_CREATED);

        }else{
            $foodrelease = [
                'dateOfrelease'             =>  $request['dateOfrelease'],
                'dzongkhag_id'              =>  $request['dzongkhag'],
                'org_id'                    =>  $request['organizaiton'],
                'quarter_id'                =>  $request['quarter'],
                'remarks'                   =>  $request['remarks'],
                'updated_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];
        // dd($foodrelease);
            $foodrel = FoodRelease::create($foodrelease);
            $attachmentId =  $foodrel->id;
            if($request->attachment_details!=null && $request->attachment_details!=""){
                foreach($request->attachment_details as $att){
                    $attach =[
                        'attachmentId'              =>  $attachmentId,
                        'path'                      =>  $att['path'],
                        'attachment_for'            =>  'Food Release Note',
                        'user_defined_name'         =>  $att['user_defined_name'],
                        'original_name'             =>  $att['original_name'],

                    ];
                // dd($attach);
                    FoodReleaseDocuments::create($attach);
                }
            }


        // $releasId = DB::table('food_releases')->orderBy('id','desc')->limit(1)->pluck('id');
            // dd($request->items_release);
            // foreach ($request->items_released as $i => $item){
            //     $itemreleasednote = array(
            //       //  'foodreleaseId'              =>  $releasId[0],
            //         'foodreleaseId'              =>  $foodrel->id,
            //         'item_id'                    =>  $item['item'],
            //         'quantity'                   =>  $item['quantity'],
            //         'unit_id'                    =>  $item['unit'],
            //         'remark'                     =>  $item['remarks'],
            //         'updated_by'                 =>  $request->user_id,
            //         'created_at'                 =>  date('Y-m-d h:i:s')
            //     );
            //     ItemReleasedNote::create($itemreleasednote);
            // }
            // foreach($request->attachment_details as $att){
            //     $doc_data = array(
            //       //  'foodreleaseId'              =>  $releasId[0],
            //         'foodreleaseId'              =>  $foodrel->id,
            //         'attachment_for'             =>  'Food Release Note',
            //         'path'                       =>  $att['path'],
            //         'original_name'              =>  $att['original_name'],
            //         'user_defined_name'          =>  $item['user_defined_name'],
            //         'updated_by'                 =>  $request->user_id,
            //         'created_at'                 =>  date('Y-m-d h:i:s')
            //     );
            //     FoodReleaseDocuments::create($doc_data);
            // }
            return $this->successResponse($foodrel, Response::HTTP_CREATED);
        // dd($foodrel);
        }
    }
    public function loadFoodReleaseList(){
        //   return 'from service of mine';
        $list = DB::table('food_releases')
        ->select( 'dateOfrelease as dateOfrelease',
         'dzongkhag_id as dzongkhag','org_id as organization',
         'quarter_id as quarter','remarks as remarks','id'
         )->get();
        return $list;
    }

    public function getFoodReleaseItem($foodreleaseId=''){
      $list = DB::table('item_released_notes')
      ->select( 'item_id as item','quantity','unit_id as unit')->where('foodreleaseId',$foodreleaseId)->get();
      return $list;
    }
    public function getFoodReleaseDetails($foodrelId=""){
       // dd($foodrelId);
        $response_data=FoodRelease::where('id',$foodrelId)->first();
        $response_data->attachments=FoodReleaseDocuments::where('attachmentId',$response_data->id)->get();
        return $this->successResponse($response_data);
    }

    public function ViewFoodReleaseDetials($foodreleaseId=''){
        $response_data=FoodRelease::where('id',$foodreleaseId)->first();
        if($response_data!="" && $response_data!=null){
            $response_data->attachments=FoodReleaseDocuments::where('attachmentId',$response_data->id)->get();
        }
        return $this->successResponse($response_data);
    }
    public function deleteFile($id=""){
        $attachment = FoodReleaseDocuments::findOrFail($id);
        $attachment->delete();
        return $this->successResponse($attachment);
    }
}
