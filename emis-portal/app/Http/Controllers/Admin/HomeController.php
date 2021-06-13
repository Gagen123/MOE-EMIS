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
            // dd($data);
            $response_data = $this->apiService->createData('portallogin', $data);
            dd($response_data);
            if(json_decode($response_data)==null || json_decode($response_data)=="null" || json_decode($response_data)=="Not Found"){
                return view('userlogin',['Invalid'=>'No able to validate details. Please check your route connections and calling urls']);
            }
            if(isset(json_decode($response_data)->error)){
                return view('userlogin',['Invalid'=>json_decode($response_data)->error]);
            }
            $auth = new UserAuth();
            $accessList = $auth->setAuth(json_decode($response_data)->access_token);
            $users = [
                'accessList'=> $accessList,
                'token' => json_decode($response_data)->access_token,
                'user' => $auth->getuser(json_decode($response_data)->access_token),
                'roles' => $auth->getRole(json_decode($response_data)->access_token),
            ];
            Session::put([
                'User_details'=> $users,
            ]);

        }
        return redirect()->away('/dashboard');
    }
    public function user_logout(){
        Session::forget('User_Details');
        Session::flush();
        return view('welcome',['Invalid'=>'']);
    }
}
