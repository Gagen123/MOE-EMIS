<?php

namespace App\Http\Controllers;
use App\Helper\EmisService;
use Illuminate\Http\Request;

class RequestadmissionController extends Controller
{
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    //
    public function savedrequestadmission(Request $request){
        // dd($request);
        $rules = [
            'dateOfapply'               => 'required',
            
        ];
        $customMessages = [
            'dateOfapply.required'        => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'dzongkhag'                  =>  $request->dzongkhag,
            'school'                     =>  $request->school,
            'class'                      =>  $request->class,
            'stream'                     =>  $request->stream,
            'dateOfapply'                =>  $request->dateOfapply,
            'reasons'                    =>  $request->reasons,
            'snationality'               =>  $request->snationality,
        ];
        $response_data= $this->apiService->createData('emis/students/admission/savedrequestadmission', $data);
        return $response_data;
        

    }
}
