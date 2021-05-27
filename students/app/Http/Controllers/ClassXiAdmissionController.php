<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ClassXiAdmission;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class ClassXiAdmissionController extends Controller
{
    use ApiResponser;
    public $database="student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  savedetailsClassXi(Request $request){
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
            $response_data = ClassXiAdmission::create($data);
        
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassXiAdmission  $classXiAdmission
     * @return \Illuminate\Http\Response
     */
    public function show(ClassXiAdmission $classXiAdmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassXiAdmission  $classXiAdmission
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassXiAdmission $classXiAdmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassXiAdmission  $classXiAdmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassXiAdmission $classXiAdmission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassXiAdmission  $classXiAdmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassXiAdmission $classXiAdmission)
    {
        //
    }
}
