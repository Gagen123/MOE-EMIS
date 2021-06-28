<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

trait AuthUser
{
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
    public function srdCid(){
        return $this->currentUser()['cid'];
    }

}
