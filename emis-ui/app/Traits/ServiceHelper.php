<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ServiceHelper
{
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
        try{
            $response = $client->request($method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers]);
            return $response->getBody()->getContents();
        }catch(\Exception $e){
            return $e->getResponse()->getBody()->getContents();
        }
            
    }
    
}