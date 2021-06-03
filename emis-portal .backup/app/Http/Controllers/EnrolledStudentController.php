<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helper\EmisService;

class EnrolledStudentController extends Controller
{
    public $apiService;
    public function __construct(EmisService $apiService){
    $this->apiService = $apiService;
    }
    
    public function index()
    {
        //
    }

    public function savedetailsEnrolledStd(Request $request){
        // dd($request);
        $rules = [
            // 'dzongkhag'                 => 'required',
            // 'school'                    => 'required',
            // 'class'                     => 'required',
            // 'stream'                    => 'required',
            'dateOfapply'               => 'required',
            
        ];
        $customMessages = [
            // 'dzongkhag.required'          => 'This field is required',
            // 'school.required'             => 'This field is required',
            // 'class.required'              => 'This field is required',
            // 'stream.required'             => 'This field is required',
            'dateOfapply.required'        => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'dzongkhag'                  =>  $request->dzongkhag,
            'school'                     =>  $request->school,
            'class'                      =>  $request->class,
            'stream'                     =>  $request->stream,
            'dateOfapply'                =>  $request->dateOfapply,
            'remarks'                    =>  $request->remarks,
        ];
        $response_data= $this->apiService->createData('emis/students/admission/savedetailsEnrolledStd', $data);
        return $response_data;

    }

  
}
