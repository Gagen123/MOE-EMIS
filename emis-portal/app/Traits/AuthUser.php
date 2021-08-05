<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

trait AuthUser
{
    public function currentUser(){
        return Session::get('User_details');

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
        return $this->currentUser()->id;
    }
    public function stdCid(){
        return $this->currentUser()->std_cid;
    }

}
