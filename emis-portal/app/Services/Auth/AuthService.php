<?php

namespace App\Services\Auth;

use App\Traits\ServiceHelper;

class AuthService
{
    use ServiceHelper;
    public $baseUri;
    public $secret;
    // public $service_code = "/admin_api/v1";

    public function __construct()
    {
        $this->baseUri = config('services.authService.base_uri');
        // $this->secret = config('services.admin.secret');
    }

    public function listData($endpoint, $data = [], $headers = [])
    {
        // return $this->baseUri;
        // return $this->performRequest('GET', '/indicatorcategories');
        // if ($data == null) {
        //     return $this->performRequest('GET', $endpoint);
        // }
        return $this->performRequest('GET', $endpoint, $data, $headers);
    }

    public function postData($endpoint, $data = [], $headers = [])
    {
        // dd($headers);
        return $this->performRequest('POST', $endpoint, $data, $headers);
    }


}