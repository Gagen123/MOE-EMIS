<?php

namespace App\Http\Controllers\organization;

use Session;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;

class CompoundDetailsController extends Controller
{
    //
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    } 

    public function saveSchoolCompundDetails(Request $request){
       //dd('from UI');
        $rules = [
            'thramno'               =>  'required',
            'plotno'                =>  'required',
            'peginfo'               =>  'required',
            'sizecompound'          =>  'required',
            'sizeplayground'        =>  'required',
            'playgroundused'        =>  'required',
            'status'                =>  'required',
           // 'agriculturalarea'      =>  'required',
          //  'areaused'              =>  'required',
           

        ];
        $customMessages = [
            'thramno.required'                  => 'thramno is required',
            'plotno.required'                   => 'plotno is required',
            'peginfo.required'                  => 'peginfo is required',
            'sizecompound.required'             => 'sizecompound is required',
            'sizeplayground.required'           => 'sizeplayground is required',
            'playgroundused.required'           => 'playgroundused is required',
            'status.required'                   => 'agriculturalarea is required',
         //   'agriculturalarea'                  => 'agriculturalarea is required',
         //   'areaused'                          => 'areaused is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $comp =[
            'organizationId'                =>  $this->getWrkingAgencyId(),
            'thramno'                       =>  $request['thramno'],
            'plotno'                        =>  $request['plotno'],
            'peginfo'                       =>  $request['peginfo'],
            'sizecompound'                  =>  $request['sizecompound'],
            'sizeplayground'                =>  $request['sizeplayground'],
            'playgroundused'                =>  $request['playgroundused'],
            'status'                        =>  $request['status'],
            'agriculturalarea'              =>  $request['agriculturalarea'],
            'areaused'                      =>  $request['areaused'],
            'id'                            =>  $request['id'],
            'user_id'                       =>  $this->userId()
        ];
       //  dd($comp);
        try{
            $response_data= $this->apiService->createData('emis/organization/compoundDetails/saveSchoolCompundDetails', $comp);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    public function loadcompoundareadetials($org_id=""){
        //  dd('m here');
        $list = $this->apiService->listData('emis/organization/compoundDetails/loadcompoundareadetials'.$org_id);
        return $list;
    }

}
