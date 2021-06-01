<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helper\EmisService;

use function PHPSTORM_META\type;

// use Illuminate\Http\Response;

class ClassXIController extends Controller
{
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    //
    public function savedetailsEnrolledStd(Request $request){
        // dd($request);
        $rules = [
            // 'dzongkhag'                 => 'required',
            // 'school'                    => 'required',
            // 'class'                     => 'required',
            // 'stream'                    => 'required',
            'dateOfapply'               => 'required',
            // 'student_type'              => 'student_type',
            
        ];
        $customMessages = [
            // 'dzongkhag.required'          => 'This field is required',
            // 'school.required'             => 'This field is required',
            // 'class.required'              => 'This field is required',
            // 'stream.required'             => 'This field is required',
            // 'dateOfapply.required'        => 'This field is required',
            'student_type.required'       => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data = $request->all();
        
        $response_data= $this->apiService->createData('emis/students/admission/savedetailsEnrolledStd', $data);
        return $response_data;

    }
}
