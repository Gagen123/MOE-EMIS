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

class EstablishmentController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function getLevelInDropdown(){
        $level = $this->apiService->listData('emis/organization/establishment/getLevelInDropdown');
        return $level;
    }

    public function getLocationInDropdown(){
        $level = $this->apiService->listData('emis/organization/establishment/getLocationInDropdown');
        return $level;
    }

    public function saveEstablishment(Request $request){
        $rules = [
            'proposedName'          =>  'required',
            'level'                 =>  'required',
            'category'              =>  'required',
            'dzongkhag'             =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'locationType'          =>  'required',
            'senSchool'             =>  'required',
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'level.required'                => 'Level is required',
            'category.required'             => 'Category is required',
            'dzongkhag.required'            => 'Dzongkhag is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'locationType.required'         => 'Location Type  is required',
            'senSchool.required'            => 'Sen School is required',
            
        ];
        $this->validate($request, $rules, $customMessages);
        $estd =[
            'proposedName'                 =>  $request['proposedName'],
            'level'                        =>  $request['level'],
            'category'                     =>  $request['category'],
            'dzongkhag'                    =>  $request['dzongkhag'],
            'gewog'                        =>  $request['gewog'],
            'chiwog'                       =>  $request['chiwog'],
            'locationType'                 =>  $request['locationType'],
            'senSchool'                    =>  $request['senSchool'],
            'geopolicaticallyLocated'      =>  $request['geopolicaticallyLocated'],
            'parentSchool'                 =>  $request['parentSchool'],
            'cid'                          =>  $request['cid'],
            'name'                         =>  $request['name'],
            'phoneNo'                      =>  $request['phoneNo'],
            'email'                        =>  $request['email'],
            'id'                           =>  $request['id'],
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/establishment/saveEstablishment', $estd);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function saveClassStream(Request $request){
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
            $response_data= $this->apiService->createData('emis/organization/establishment/saveClassStream', $classStream);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function getClass(){
        $classInCheckbox = $this->apiService->listData('emis/organization/establishment/getClass');
        return $classInCheckbox;
    }

    public function getStream(){
        $streamInCheckbox = $this->apiService->listData('emis/organization/establishment/getStream' );
        return $streamInCheckbox;
    }

}
