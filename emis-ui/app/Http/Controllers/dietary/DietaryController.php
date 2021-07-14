<?php

namespace App\Http\Controllers\dietary;

//use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;
class DietaryController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function savediatery(Request $request){
        // $rules = [
        //     'record_date'         =>  'required',
        // ];
        // $customMessages = [
        //     'dateOfissue.record_date'            => 'this field is required',
        // ];
        // $this->validate($request, $rules, $customMessages);
        $request_data =[
            // 'total_score'               =>  $request->total_score,
            // 'id'                        =>  $request->id,
            // 'record_date'               =>  $request->record_date,

            // 'remarks'                   =>  $request->remarks,
            // 'b_cereal'                  =>  $request->b_cereal,
            // 'b_root'                    =>  $request->b_root,
            // 'b_veg'                     =>  $request->b_veg,
            // 'b_meat'                    =>  $request->b_meat,
            // 'b_egg'                     =>  $request->b_egg,
            // 'b_fish'                    =>  $request->b_fish,
            // 'b_pulse'                   =>  $request->b_pulse,
            // 'b_milk'                    =>  $request->b_milk,
            // 'b_fruit'                   =>  $request->b_fruit,
            // 'b_oil'                     =>  $request->b_oil,
            // 'b_sugar'                   =>  $request->b_sugar,
            // 'b_chilli'                  =>  $request->b_chilli,
            // 'l_cereal'                  =>  $request->l_cereal,
            // 'l_root'                    =>  $request->l_root,
            // 'l_veg'                     =>  $request->l_veg,
            // 'l_meat'                    =>  $request->l_meat,
            // 'l_egg'                     =>  $request->l_egg,
            // 'l_fish'                    =>  $request->l_fish,
            // 'l_pulse'                   =>  $request->l_pulse,
            // 'l_milk'                    =>  $request->l_milk,
            // 'l_fruit'                   =>  $request->l_fruit,
            // 'l_oil'                     =>  $request->l_oil,
            // 'l_sugar'                   =>  $request->l_sugar,
            // 'l_chilli'                  =>  $request->l_chilli,
            // 't_cereal'                  =>  $request->t_cereal,
            // 't_root'                    =>  $request->t_root,
            // 't_veg'                     =>  $request->t_veg,
            // 't_meat'                    =>  $request->t_meat,
            // 't_egg'                     =>  $request->t_egg,
            // 't_fish'                    =>  $request->t_fish,
            // 't_pulse'                   =>  $request->t_pulse,
            // 't_milk'                    =>  $request->t_milk,
            // 't_fruit'                   =>  $request->t_fruit,
            // 't_oil'                     =>  $request->t_oil,
            // 't_sugar'                   =>  $request->t_sugar,
            // 't_chilli'                  =>  $request->t_chilli,
            // 'd_cereal'                  =>  $request->d_cereal,
            // 'd_root'                    =>  $request->d_root,
            // 'd_veg'                     =>  $request->d_veg,
            // 'd_meat'                    =>  $request->d_meat,
            // 'd_egg'                     =>  $request->d_egg,
            // 'd_fish'                    =>  $request->d_fish,
            // 'd_pulse'                   =>  $request->d_pulse,
            // 'd_milk'                    =>  $request->d_milk,
            // 'd_fruit'                   =>  $request->d_fruit,
            // 'd_oil'                     =>  $request->d_oil,
            // 'd_sugar'                   =>  $request->d_sugar,
            // 'd_chilli'                  =>  $request->d_chilli,

            'items1'                  =>  $request->items1,
            'items2'                  =>  $request->items2,
            'items3'                  =>  $request->items3,
            'items4'                  =>  $request->items4,
            'items5'                  =>  $request->items5,
            'items6'                  =>  $request->items6,
            'items7'                  =>  $request->items7,
            'record_date1'            =>  $request->record_date1,
            'record_date2'            =>  $request->record_date2,
            'record_date3'            =>  $request->record_date3,
            'record_date4'            =>  $request->record_date4,
            'record_date5'            =>  $request->record_date5,
            'record_date6'            =>  $request->record_date6,
            'record_date7'            =>  $request->record_date7,
            'total_score1'            =>  $request->total_score1,
            'total_score2'            =>  $request->total_score2,
            'total_score3'            =>  $request->total_score3,
            'total_score4'            =>  $request->total_score4,
            'total_score5'            =>  $request->total_score5,
            'total_score6'            =>  $request->total_score6,
            'total_score7'            =>  $request->total_score7,
            'average_score'           =>  $request->average_score,
            'remarks'                 =>  $request->remarks,
            'prepared_by'             =>  $request->prepared_by,
            'endrosed_by'             =>  $request->endrosed_by,
            'action_type'             =>  $request->action_type,
            'user_id'                 =>  $this->userId(),
            'org_id'                  =>  $this->getWrkingAgencyId()
        ];
        $response_data= $this->apiService->createData('emis/dietary/savediatery', $request_data);
        return $response_data;
    }

    public function getdiatery($org_id=""){
        $list = $this->apiService->listData('emis/dietary/getdiatery/'.$org_id);
        return $list;
    }

    public function getdiateryDetails($id=""){
        $list = $this->apiService->listData('emis/dietary/getdiateryDetails/'.$id);
        return $list;
    }

    public function checkdata($date=""){
        $list = $this->apiService->listData('emis/dietary/checkdata/'.$date.'/'.$this->getWrkingAgencyId());
        return $list;
    }
}
