<?php

namespace App\Http\Controllers\Admin;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UserAuth;
use App\Traits\ServiceHelper;

class HomeController extends Controller
{
    public $apiService;
    use ServiceHelper;
    public function __construct(EmisService $apiService)
    {
        $this->apiService = $apiService;
    }
    function login_screen(){
        return view('userlogin',['Invalid'=>'']);
    }

    function user_register(){
        return view('register',['Invalid'=>'']);
    }

    function userlogin(Request $request){
        $rules = [
            'email'  =>  'required',
            'password'  =>  'required',
        ];

        $customMessages = [
            'email.required' => 'User name field is required',
            'password.required' => 'Password field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data = $request->only('email', 'password');
        if( Session::get('User_details')==null){
            $response_data = $this->apiService->createData('emisportallogin', $data);
            // dd($response_data);
            if(json_decode($response_data)==null || json_decode($response_data)=="null" || json_decode($response_data)=="Not Found"){
                return view('userlogin',['Invalid'=>'No able to validate details. Please check your route connections and calling urls']);
            }
            if(isset(json_decode($response_data)->error)){
                return view('userlogin',['Invalid'=>json_decode($response_data)->error]);
            }
            $auth = new UserAuth();
            $users = [
                'user' => $auth->getuser(json_decode($response_data)->access_token),
            ];
            // dd($users);
            Session::put([
                'User_details'=> $users['user'],
            ]);
        }
        return redirect()->away('/dashboard');
    }
    public function user_logout(){
        Session::forget('User_details');
        Session::flush();
        return view('index',['Invalid'=>'']);
    }

    public function getSessionDetail(){
        if(Session::get('User_details')!=""){
            return ['data' => Session::get('User_details')];
        }
        else{
            return redirect()->away('user_logout');
        }
    }

    public function save_new_registration(Request $request){
        if($request->registrationType==1){
            $rules = [
                'name'            =>  'required',
                'contact'         =>  'required',
                'email'           =>  'required',
                'password1'       =>  'required',
            ];
            $customMessages = [
                'name.required'      => 'Student Name field is required',
                'contact.required'   => 'Contact Field is required',
                'email.after'        => 'Email is required',
                'password1.required' => 'Password is required',

            ];
            $this->validate($request, $rules,$customMessages);
        }
        if($request->registrationType==2){
            $rules = [
                'student_code'      =>  'required',
                'dob'               =>  'required',
            ];
            $customMessages = [
                'student_code.required' => 'Student code is required',
                'dob.required' => 'DOB is required',
            ];
            $this->validate($request, $rules,$customMessages);
        }
        if($request->registrationType==3){
            $rules = [
                'vacancyId'          =>  'required',
            ];
            $customMessages = [
                'vacancyId.required' => 'Please check Registering for',
            ];
            $this->validate($request, $rules,$customMessages);
        }
        $response_data=$this->apiService->createData('save_new_registration', $request->all());
        if(json_decode($response_data)->id!=null && json_decode($response_data)->id!=""){
            return view('userlogin',['Invalid'=>'Thank you for registering with MOE, You may login with your email and password to proceed further.']);
        }
        else{
            return view('userlogin',['Invalid'=>'Not able to register with us. Please contact system administrator for further assistant.']);
        }

    }
    function change_password_portal(Request $request){
        if(Session::get('User_details')!=""){
            $data =[
                'current_password' => $request->input('current_password'),
                'confirm_password' => $request->input('confirm_password'),
                'userId' => Session::get('User_details')->id
            ];
            $response_data = $this->apiService->createData('change_password_portal', $data);
            return $response_data;
        }
        else{
            return redirect()->route('session_out');
        }

    }

}
