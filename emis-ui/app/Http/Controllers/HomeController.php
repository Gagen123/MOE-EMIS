<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Helper\EmisService;
use App\Models\Process;
use App\Models\ActionType;
use App\Models\Role;

class HomeController extends Controller{
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function index(Request $request){
        if(Session::get('User_Details')!=""){
            //dd(Session::get('User_Details'));
            return view('dashboard');
        }
        else{  
            if($request->param!=""){
                $user_Det= Crypt::decryptString($request->param);
                $user=json_decode($user_Det)->user_details->user;
                // dd($user);
                $token =json_decode($user_Det)->user_details->token;
                $headers['Authorization'] = 'bearer '. $token;
                // dd(json_decode($user_Det)->system_id);
                $role_riv=$this->apiService->listData('getprivilleges/'.json_decode($user_Det)->system_id, [], $headers);
                $role_riv=json_decode($role_riv);
                $role_workflow_submitter=$this->apiService->listData('getworkflows/submitter/'.json_decode($user_Det)->system_id, [], $headers);
                // dd($role_riv);
                $module=[];
                $mod_ids="";
                $sub_modules=[];
                $sub_mod_ids="";
                $screens=[];
                $screens_ids="";
                $action_name="";
                if($role_riv!=null){
                    foreach($role_riv as $i=> $priv){
                        //dd(strpos($mod_ds,$priv->module_id));
                        if($priv->moudle_name != "" && strpos($mod_ids,$priv->module_id)===false){
                            $mod_ids.=$priv->module_id.',';
                            $mod=[
                                'mod_id'=> $priv->module_id,
                                'mod_name' => $priv->moudle_name,
                                'module_icon'=>$priv->module_icon,
                                'module_route'=>$priv->module_route,
                            ];
                            array_push($module,$mod);
                        }
                        if($priv->sub_module_name != "" && $priv->Type == "Sub_module" && strpos($sub_mod_ids,$priv->sub_module_id)===false){
                            $sub_mod_ids.=$priv->sub_module_id.',';
                            $sub_mod=[
                                'mod_id'=> $priv->module_id,
                                'sub_mod_id'=> $priv->sub_module_id,
                                'sub_mod_name' => $priv->sub_module_name,
                                'submod_icon'=>$priv->submod_icon,
                                'submod_route' =>$priv->sub_mod_route,
                            ];
                            array_push($sub_modules,$sub_mod);
                        }
                        if($priv->Organization == 1 || $priv->Dzongkhag == 1 || $priv->National == 1 ){
                            if(strpos($screens_ids,$priv->Id)===false){
                                $actions=$this->apiService->listData('load_action/'.$priv->Id, [], $headers);
                                $screens_ids.=$priv->Id.',';
                                $screen=[
                                    'mod_id'=> $priv->module_id,
                                    'sub_mod_id'=> $priv->sub_module_id,
                                    'screen_id' => $priv->Id,
                                    'screen_name' => $priv->screenName,
                                    'route' =>$priv->Route,
                                    'work_flow_status'=>'NA',
                                    'actions' => json_decode($actions)[0]->action_name,
                                    'screen_icon'=>$priv->screen_icon,
                                ];
                                array_push($screens,$screen);
                            }
                        }
                    }
                }

                // dd($role_workflow_submitter);
                if($role_workflow_submitter!=null){
                    foreach(json_decode($role_workflow_submitter) as $i=> $work){
                        if($work->moduleName != "" && strpos($mod_ids,$work->mod_id)===false){
                            $mod_ids.=$work->mod_id.',';
                            $mod=[
                                'mod_id'=> $work->mod_id,
                                'mod_name' => $work->moduleName,
                                'module_icon'=>$work->module_icon,
                                'module_route'=>$work->module_route,
                            ];
                            array_push($module,$mod);
                        }
                        if($work->sub_mod_name != "" && strpos($sub_mod_ids,$work->sub_mod_id)===false){
                            $sub_mod_ids.=$work->sub_mod_id.',';
                            $sub_mod=[
                                'mod_id'=> $work->mod_id,
                                'sub_mod_id'=> $work->sub_mod_id,
                                'sub_mod_name' => $work->sub_mod_name,
                                'submod_icon'=>$work->submod_icon,
                                'submod_route' =>$work->sub_mod_route,
                            ];
                            array_push($sub_modules,$sub_mod);
                        }
                        // dd($sub_modules);
                        $screen=[
                            'mod_id'=> $work->mod_id,
                            'sub_mod_id'=> $work->sub_mod_id,
                            'screen_id' => $work->screen_id,
                            'screen_name' => $work->screen_name,
                            'route' =>$work->Route,
                            'screen_icon'=>$work->screen_icon,
                            'work_flow_status'=>$work->Sequence,
                            'actions' => 'null'
                        ];
                        array_push($screens,$screen);
                    }
                }
                
                //dd($screen);
                $roles=json_decode($user_Det)->user_details->roles;
                $user_details=[
                    'User_Id'=>$user->id,
                    'staff_id'=>$user->staff_id,
                    'Passport_CID'  => $user->cid_emp_id,
                    'Full_Name'  => $user->full_name,
                    'Contact_Number'  =>  $user->phone_number,
                    'Email'  =>  $user->email,
                    //'Role_Id'=>  $user->id,
                    'Agency_Code' =>  $user->org_organization_id,
                    'Dzo_Id' =>  $user->dzon_id,
                    'Geo_Id' =>  $user->gewog_id,
                    'Village_Id' =>  $user->village_id,
                    'Center_Id' =>  $user->nfe_center_id,
                    'modules'  => $module,
                    'sub_modules' =>$sub_modules,
                    'screens'=>$screens,
                    'ministry_user'=>$user->ministry_user,
                    'roles' => $roles,//roles will be multiple
                    'system_id' =>json_decode($user_Det)->system_id,
                ];

                // dd($user_details);
                $role_workflow=$this->apiService->listData('getworkflows/all/'.json_decode($user_Det)->system_id, [], $headers);
                Session::put('User_Details', $user_details);
                Session::put('User_Token', $token);
                
                //dd(json_decode($role_workflow));
                Session::put('role_priv', $role_riv);
                Session::put('role_workflow', $role_workflow);
                return redirect()->route('dashboard');
            }
            else{
                $redirection_url=config('services.login.base_uri').'logout';
                return redirect()->away($redirection_url);
            }
        }
    }

    public function dashboard(Request $request){
        //dd(Session::get('User_Details'));
        if(Session::get('User_Details')!=""){
            return view('dashboard');
        }
        else{
            $redirection_url=config('services.login_logout.logout_uri').'session_out';
            return redirect()->away($redirection_url);
        }
    }
    public function get_screens_on_submodules(Request $request,$type="",$id=""){
        $token =Session::get('User_Token');
        $headers['Authorization'] = 'bearer '. $token;
        // dd($type.' : '.$id.':'.Session::get('User_Details')['system_id']);
        $role_riv=$this->apiService->listData('getprivillegesbyid/'.$id.'/'.$type, [], $headers);
        $role_workflow_submitter=$this->apiService->listData('getworkflows/submitter/'.Session::get('User_Details')['system_id'], [], $headers);
        // dd($role_workflow_submitter);
        $screens=[];
        $screens_ids="";
        if($role_riv!=null){
            foreach(json_decode($role_riv) as $i=> $priv){
                if(strpos($screens_ids,$priv->Id)===false){  
                    $actions=$this->apiService->listData('load_action/'.$priv->Id, [], $headers);
                    $screens_ids.=$priv->Id.',';
                    $screen=[
                        'mod_id'=> $priv->module_id,
                        'sub_mod_id'=> $priv->sub_module_id,
                        'screen_id' => $priv->Id,
                        'screen_name' => $priv->screenName,
                        'route' =>$priv->Route,
                        'work_flow_status'=>'NA',
                        'actions' => json_decode($actions)[0]->action_name,
                        'screen_icon'=>$priv->screen_icon,
                    ];
                    array_push($screens,$screen);
                }
            }
        }
        return $screens;
    }

    public function logout(Request $request){
        Session::forget('User_Details');
        Session::flush();
        $redirection_url=config('services.login_logout.logout_uri').'logout';
        return redirect()->away($redirection_url);
    }
    public function select_system(){
        return redirect()->away(config('services.login_logout.logout_uri').'system_select');
    }

}
