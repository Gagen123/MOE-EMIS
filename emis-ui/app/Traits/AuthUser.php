<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

trait       AuthUser
{
    /**
     * Send a request to any service
     * @return string
     */
    public function currentUser(){
        return Session::get('User_Details');

    }
    public function getRoleIds($param=""){
        $response="";
        foreach($this->currentUser()['roles'] as $role){
            $response.=$role->Id.',';
        }
        if($param=="roleIds"){
            return rtrim($response, ",");
        }
    }

    public function userId(){
        return $this->currentUser()['User_Id'];
    }
    public function staffId(){
        return $this->currentUser()['staff_id'];
    }
    public function getAccessLevel(){
        return $this->currentUser()['acess_level'];
    }
    public function getUserDzoId(){
        return $this->currentUser()['Dzo_Id'];
    }
    public function getWrkingAgencyId(){
        return $this->currentUser()['Agency_Code'];
    }
    public function getsubmitterStatus($param=""){
        $works=Session::get('role_workflow');
        $w_status=0;
        $screen_id=0;
        foreach(json_decode($works) as $i=> $work){
            if (strpos(strtolower($work->process_name), $param) !== false) {
                if($w_status>1 && $work->Sequence<$w_status){ //make sure it is of lowest verification
                    $w_status= $work->Sequence;
                    $screen_id=$work->screen_id;
                }
                else{
                    $w_status= $work->Sequence;
                    $screen_id=$work->screen_id;
                }
            }
        }
        return [
           'status' =>$w_status,
           'screen_id' =>$screen_id,
        ];
    }

    public function getVerificationApprovalWorkStatus(){
        $works=Session::get('role_workflow');
        $w_status_screen=[];
        foreach(json_decode($works) as $i=> $work){
            if($work->Sequence>1){
                array_push($w_status_screen,$work->screen_id.'SSS'.($work->Sequence - 1));
            }
        }
        return $w_status_screen;
    }
    public function getCurrentWorkflowStatus($screenId=""){
        $works=Session::get('role_workflow');
        $w_status="";
        foreach(json_decode($works) as $i=> $work){
            //$w_status.=$work->screen_id.'; ';
            if($work->screen_id==$screenId){
                $w_status=$work->workflow_status;
            }
        }
        return $w_status;
    }

    public function getAllCurrentWorkflowStatus($screenId=""){
        $works=Session::get('role_workflow');
        $w_status="";
        foreach(json_decode($works) as $i=> $work){
            //$w_status.=$work->screen_id.'; ';
            if($work->screen_id==$screenId){
                $w_status.=$work->workflow_status.', ';
            }
        }
        return $w_status;
    }

    // public function getcurrentworkflowStatusForUpdate($param=""){
    //     $works=Session::get('role_workflow');
    //     $w_status=0;
    //     $screen_id=0;
    //     foreach(json_decode($works) as $i=> $work){
    //         if (strpos(strtolower($work->process_name), $param) !== false) {
    //             if($work->Sequence!=1){
    //                 $w_status= $work->Sequence;
    //                 $screen_id=$work->screen_id;
    //             }
    //         }
    //     }
    //     return [
    //        'status' =>$w_status,
    //        'screen_id' =>$screen_id,
    //     ];
    // }

    
    
}
