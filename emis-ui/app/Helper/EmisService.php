<?php

namespace App\Helper;

use App\Traits\ServiceHelper;

class EmisService
{
    use ServiceHelper;
    public $baseUri;
    public function __construct(){
        $this->baseUri = config('services.api_gateway.base_uri');
    }

    public function listData($endpoint, $data = [], $headers = []) {
        return $this->performRequest('GET', $endpoint, $data, $headers);
    }

    public function createData($endpoint, $data = [], $headers = []) {
        return $this->performRequest('POST', $endpoint, $data, $headers);
    }

    public function viewData($endpoint, $id){
        return $this->performRequest('GET',  "$endpoint/{$id}");
    }

    public function editData($endpoint, $data, $id){
        return $this->performRequest('PUT', "$endpoint/{$id}", $data);
    }

    public function deleteData($endpoint, $id){
        return $this->performRequest('DELETE', "$endpoint/{$id}");
    }

    public function getListData($endpoint, $id = null){
        $uri = $id == null ? "$endpoint" : "$endpoint/{$id}";
        return $this->performRequest('GET', $uri);
    }
}