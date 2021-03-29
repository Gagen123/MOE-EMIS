<?php

namespace App\Http\Controllers\organization;

use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Http\Controllers\Controller;

class RestructuringController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveChangeBasicDetails(Request $request){
        $rules = [

        ];
        $customMessages = [

        ];
        $this->validate($request, $rules, $customMessages);
        $change =[
            'name'                      =>  $request['name'],
            'level'                     =>  $request['level'],
            'category'                  =>  $request['category'],
            'dzongkhag'                 =>  $request['dzongkhag'],
            'gewog'                     =>  $request['gewog'],
            'chiwog'                    =>  $request['chiwog'],
            'locationType'              =>  $request['locationType'],
            'geoLocated'                =>  $request['geoLocated'],
            'senSchool'                 =>  $request['senSchool'],
            'geoLocated'                =>  $request['geoLocated'],
            'coLocated'                 =>  $request['coLocated'],  
            'id'                        =>  $request['id'],
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/changeDetails/saveBasicChangeDetails', $change);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function saveChangeClass(Request $request){
        $rules = [
            'class'          =>  'required',
            
        ];
        $customMessages = [
            'class.required'         => 'Class is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $classStream =[
            'class'        =>  $request['class'],
            'stream'        =>  $request['stream'],
            'user_id'        =>  $this->user_id() ,
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/changeDetails/saveChangeClass', $classStream);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function saveMerger(Request $request){
        $rules = [
            'name'              =>  'required',
            'level'             =>  'required',
            'category'          =>  'required',
            'dzongkhag'         =>  'required',
            'gewog'             =>  'required',
            'chiwog'            =>  'required',
            'location'          =>  'required',
            'senSchool'         =>  'required',

        ];
        $customMessages = [
            'name.required'         => 'Name is required',
            'level.required'        => 'Level is required',
            'category.required'     => 'Category is required',
            'dzongkhag.required'    => 'Dzongkhag is required',
            'gewog.required'        => 'Gewog is required',
            'chiwog.required'       => 'Chiwog is required',
            'location.required'     => 'Location Type is required',
            'senSchool.required'    => 'SEN School is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $merger =[
            'name'                     =>  $request['name'],
            'category'                 =>  $request['category'],
            'level'                    =>  $request['level'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'gewog'                    =>  $request['gewog'],
            'chiwog'                   =>  $request['chiwog'],
            'location'                 =>  $request['location'],
            'geoLocated'               =>  $request['geoLocated'],
            'senSchool'                =>  $request['senSchool'],
            'parentSchool'             =>  $request['parentSchool'],
            'coLocated'                =>  $request['coLocated'],
            'orgId1'                   =>  $request['orgId1'],
            'orgId2'                   =>  $request['orgId2'],
            'year'                     =>  $request['year'],
            'id'                       =>  $request['id'],
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/merger/saveMerger', $merger);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function saveClosure(Request $request){
        $rules = [
            'reason'          =>  'required',
        ];
        $customMessages = [
            'reason.required'      => 'Reason is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $closure =[
            'code'                     =>  $request['code'],
            'name'                     =>  $request['name'],
            'category'                 =>  $request['category'],
            'level'                    =>  $request['level'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'gewog'                    =>  $request['gewog'],
            'chiwog'                   =>  $request['chiwog'],
            'location'                 =>  $request['location'],
            'geoLocated'               =>  $request['geoLocated'],
            'senSchool'                =>  $request['senSchool'],
            'reason'                   =>  $request['reason'],
            'remark'                   =>  $request['remark'],
            'id'                       =>  $request['id'],
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/closure/saveClosure', $closure);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
}
