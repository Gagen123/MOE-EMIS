<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\DietaryBasic;
use App\Models\Dietarydates;
use App\Models\DietaryDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class DietaryController extends Controller{
    use ApiResponser;
    public function __construct()    {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function savediatery(Request $request){

        $basic_details = [
            'average_score'                      =>  $request->average_score,
            // 'prepared_by'                        =>  $request->prepared_by,
            'remarks'                            =>  $request->remarks,
            // 'endrosed_by'                        =>  $request->endrosed_by,
            'organizationId'                     =>  $request->org_id,
            'dzongkhagId'                        =>  $request->dzo_id,
            'status'                             =>  'Submitted'
        ];
        if($request->action_type=="add"){
            $basic_details = $basic_details+[
                'created_by'                 =>  $request->user_id,
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $basic = DietaryBasic::create($basic_details);
        }
        else{
            $basic_details = $basic_details+[
                'updated_by'                 =>  $request->user_id,
                'updated_at'                 =>  date('Y-m-d h:i:s')
            ];
            DietaryBasic::where('id',$request->id)->update($basic_details);
            $basic = DietaryBasic::where('id',$request->id)->first();
        }

        if($request->action_type=="add"){
            if($request->items1!=null && $request->items1!="" && sizeof($request->items1)>0){
                //Day 1
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'record_date'               =>  $request->record_date1,
                    'total_score'               =>  $request->total_score1,
                );
                $dates =  Dietarydates::create($dietary_details);
                foreach($request->items1 as $itms){
                    $dietary_details = array(
                        'basic_id'                  =>  $basic->id,
                        'dietary_date_id'           =>  $dates->id,
                        'meal_type'                 =>  $itms['meal'],
                        'cereal'                    =>  $itms['cereal'],
                        'root'                      =>  $itms['root'],
                        'veg'                       =>  $itms['veg'],
                        'meat'                      =>  $itms['meat'],
                        'egg'                       =>  $itms['egg'],
                        'fish'                      =>  $itms['fish'],
                        'pulse'                     =>  $itms['pulse'],
                        'milk'                      =>  $itms['milk'],
                        'fruit'                     =>  $itms['fruit'],
                        'oil'                       =>  $itms['oil'],
                        'sugar'                     =>  $itms['sugar'],
                        'chilli'                    =>  $itms['chilli'],
                    );
                    $details_id =  DietaryDetails::create($dietary_details);
                }
            }


            //Day 2
            if($request->items2!=null && $request->items2!="" && sizeof($request->items2)>0){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'record_date'               =>  $request->record_date2,
                    'total_score'               =>  $request->total_score2,
                );
                $date2 =  Dietarydates::create($dietary_details);
                foreach($request->items2 as $itms){
                    $dietary_details = array(
                        'basic_id'                  =>  $basic->id,
                        'dietary_date_id'           =>  $date2->id,
                        'meal_type'                 =>  $itms['meal'],
                        'cereal'                    =>  $itms['cereal'],
                        'root'                      =>  $itms['root'],
                        'veg'                       =>  $itms['veg'],
                        'meat'                      =>  $itms['meat'],
                        'egg'                       =>  $itms['egg'],
                        'fish'                      =>  $itms['fish'],
                        'pulse'                     =>  $itms['pulse'],
                        'milk'                      =>  $itms['milk'],
                        'fruit'                     =>  $itms['fruit'],
                        'oil'                       =>  $itms['oil'],
                        'sugar'                     =>  $itms['sugar'],
                        'chilli'                    =>  $itms['chilli'],
                    );
                    $details_id =  DietaryDetails::create($dietary_details);
                }
            }

            //Day 3
            if($request->items3!=null && $request->items3!="" && sizeof($request->items3)>0){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'record_date'               =>  $request->record_date3,
                    'total_score'               =>  $request->total_score3,
                );
                $date3 =  Dietarydates::create($dietary_details);
                foreach($request->items3 as $itms){
                    $dietary_details = array(
                        'basic_id'                  =>  $basic->id,
                        'dietary_date_id'           =>  $date3->id,
                        'meal_type'                 =>  $itms['meal'],
                        'cereal'                    =>  $itms['cereal'],
                        'root'                      =>  $itms['root'],
                        'veg'                       =>  $itms['veg'],
                        'meat'                      =>  $itms['meat'],
                        'egg'                       =>  $itms['egg'],
                        'fish'                      =>  $itms['fish'],
                        'pulse'                     =>  $itms['pulse'],
                        'milk'                      =>  $itms['milk'],
                        'fruit'                     =>  $itms['fruit'],
                        'oil'                       =>  $itms['oil'],
                        'sugar'                     =>  $itms['sugar'],
                        'chilli'                    =>  $itms['chilli'],
                    );
                    $details_id =  DietaryDetails::create($dietary_details);
                }
            }

            //Day 4
            if($request->items4!=null && $request->items4!="" && sizeof($request->items4)>0){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'record_date'               =>  $request->record_date4,
                    'total_score'               =>  $request->total_score4,
                );
                $date4 =  Dietarydates::create($dietary_details);
                foreach($request->items4 as $itms){
                    $dietary_details = array(
                        'basic_id'                  =>  $basic->id,
                        'dietary_date_id'           =>  $date4->id,
                        'meal_type'                 =>  $itms['meal'],
                        'cereal'                    =>  $itms['cereal'],
                        'root'                      =>  $itms['root'],
                        'veg'                       =>  $itms['veg'],
                        'meat'                      =>  $itms['meat'],
                        'egg'                       =>  $itms['egg'],
                        'fish'                      =>  $itms['fish'],
                        'pulse'                     =>  $itms['pulse'],
                        'milk'                      =>  $itms['milk'],
                        'fruit'                     =>  $itms['fruit'],
                        'oil'                       =>  $itms['oil'],
                        'sugar'                     =>  $itms['sugar'],
                        'chilli'                    =>  $itms['chilli'],
                    );
                    $details_id =  DietaryDetails::create($dietary_details);
                }
            }

            //Day 5
            if($request->items5!=null && $request->items5!="" && sizeof($request->items5)>0){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'record_date'               =>  $request->record_date5,
                    'total_score'               =>  $request->total_score5,
                );
                $date5 =  Dietarydates::create($dietary_details);
                foreach($request->items5 as $itms){
                    $dietary_details = array(
                        'basic_id'                  =>  $basic->id,
                        'dietary_date_id'           =>  $date5->id,
                        'meal_type'                 =>  $itms['meal'],
                        'cereal'                    =>  $itms['cereal'],
                        'root'                      =>  $itms['root'],
                        'veg'                       =>  $itms['veg'],
                        'meat'                      =>  $itms['meat'],
                        'egg'                       =>  $itms['egg'],
                        'fish'                      =>  $itms['fish'],
                        'pulse'                     =>  $itms['pulse'],
                        'milk'                      =>  $itms['milk'],
                        'fruit'                     =>  $itms['fruit'],
                        'oil'                       =>  $itms['oil'],
                        'sugar'                     =>  $itms['sugar'],
                        'chilli'                    =>  $itms['chilli'],
                    );
                    $details_id =  DietaryDetails::create($dietary_details);
                }
            }

            //Day 6
            if($request->items6!=null && $request->items6!="" && sizeof($request->items6)>0){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'record_date'               =>  $request->record_date6,
                    'total_score'               =>  $request->total_score6,
                );
                $date6 =  Dietarydates::create($dietary_details);
                foreach($request->items6 as $itms){
                    $dietary_details = array(
                        'basic_id'                  =>  $basic->id,
                        'dietary_date_id'           =>  $date6->id,
                        'meal_type'                 =>  $itms['meal'],
                        'cereal'                    =>  $itms['cereal'],
                        'root'                      =>  $itms['root'],
                        'veg'                       =>  $itms['veg'],
                        'meat'                      =>  $itms['meat'],
                        'egg'                       =>  $itms['egg'],
                        'fish'                      =>  $itms['fish'],
                        'pulse'                     =>  $itms['pulse'],
                        'milk'                      =>  $itms['milk'],
                        'fruit'                     =>  $itms['fruit'],
                        'oil'                       =>  $itms['oil'],
                        'sugar'                     =>  $itms['sugar'],
                        'chilli'                    =>  $itms['chilli'],
                    );
                    $details_id =  DietaryDetails::create($dietary_details);
                }
            }

            //Day 7
            if($request->items7!=null && $request->items7!="" && sizeof($request->items7)>0){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'record_date'               =>  $request->record_date7,
                    'total_score'               =>  $request->total_score7,
                );
                $date7 =  Dietarydates::create($dietary_details);
                foreach($request->items7 as $itms){
                    $dietary_details = array(
                        'basic_id'                  =>  $basic->id,
                        'dietary_date_id'           =>  $date7->id,
                        'meal_type'                 =>  $itms['meal'],
                        'cereal'                    =>  $itms['cereal'],
                        'root'                      =>  $itms['root'],
                        'veg'                       =>  $itms['veg'],
                        'meat'                      =>  $itms['meat'],
                        'egg'                       =>  $itms['egg'],
                        'fish'                      =>  $itms['fish'],
                        'pulse'                     =>  $itms['pulse'],
                        'milk'                      =>  $itms['milk'],
                        'fruit'                     =>  $itms['fruit'],
                        'oil'                       =>  $itms['oil'],
                        'sugar'                     =>  $itms['sugar'],
                        'chilli'                    =>  $itms['chilli'],
                    );
                    $details_id =  DietaryDetails::create($dietary_details);
                }
            }
        }
        return $this->successResponse($details_id, Response::HTTP_CREATED);
    }

    public function getdiatery($org_Id=""){
        if(strpos($org_Id,'_Creater')!==false){
            $response_data = DB::table('dietary_dates')
            ->join('dietary_basic_info', 'dietary_dates.basic_id', '=', 'dietary_basic_info.id')
            ->select('dietary_basic_info.remarks','dietary_basic_info.id','dietary_basic_info.status','dietary_dates.record_date','dietary_dates.total_score')
            ->where('dietary_basic_info.created_by',explode('_',$org_Id)[0])
            ->get();
        }
        else{
            $response_data = DB::table('dietary_dates')
            ->join('dietary_basic_info', 'dietary_dates.basic_id', '=', 'dietary_basic_info.id')
            ->select('dietary_basic_info.remarks','dietary_basic_info.id','dietary_basic_info.status','dietary_dates.record_date','dietary_dates.total_score')
            ->where('dietary_basic_info.organizationId',explode('_',$org_Id)[0])
            ->get();
            //list by org wise need to check as and when use
            // $response_data = DietaryBasic::where('organizationId',explode('_',$org_Id)[0])->get();
        }
        return $response_data;
    }

    public function getdiateryDetails($id=""){
        $response_data = DietaryBasic::where('id',$id)->first();
        // $response_data->details=DietaryDetails::where('basic_id',$id)->first();
        $dates=Dietarydates::where('basic_id',$id)->get();
        $response_data->dates=$dates;
        foreach($dates as $date){
            $date->details=DietaryDetails::where('dietary_date_id',$date['id'])->get();
        }

        return $response_data;
    }

    public function checkdata($date="",$org_id=""){
        $response_data = DB::table('dietary_dates')
        ->join('dietary_basic_info', 'dietary_dates.basic_id', '=', 'dietary_basic_info.id')
        ->select('dietary_dates.*')
        ->where('dietary_dates.record_date',$date)
        ->where('dietary_basic_info.organizationId',$org_id)
        ->get();
        if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function approvereject(Request $request){
        $status='Approved';
        if($request->action_type=="reject"){
            $status='Rejected';
        }
        $basic_details = [
            'approve_reject_remarks'            =>  $request->remarks,
            'status'                            =>  $status,
            'approve_reject_by'                 =>  $request->user_id,
            'approve_reject_at'                 =>  date('Y-m-d h:i:s')
        ];
        DietaryBasic::where('id',$request->id)->update($basic_details);
        $basic = DietaryBasic::where('id',$request->id)->first();
        return $this->successResponse($basic, Response::HTTP_CREATED);
    }

}
