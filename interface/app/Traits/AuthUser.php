<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

trait AuthUser
{
    /**
     * Send a request to any service
     * @return string
     */
    public function currentUser()
    {
        return Session::get('User_Details');

    }

    public function user_id()
    {
        return $this->currentUser()['User_Id'];

    }

    public function dzo_id()
    {
        return $this->currentUser()['Dzo_Id'];

    }
}
