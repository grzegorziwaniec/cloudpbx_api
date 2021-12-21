<?php

namespace Src\Rest;

use Src\Rest\RestResponse;
/**
 *
 * @author grzesiek
 */
class RestGateway {
    
    
    private $url;
    private $auth;
    
    
    public function __construct($url,$auth) {
        $this->url = $url;
        $this->auth = $auth;
    }
    
    /**
     * 
     * @param string $method    metoda HTTP REST (GET/POST)
     * @param string $command   wywoływana komenda rest
     * @param string[] $params  parametry dodatkowe dla komendy
     * 
     * @return RestResponse
     * @throws \Exception
     */
    
    
    public function curlRequest($method, $command, $params = []) {

        $ret = false;
        $paramstr = $this->buildRequestParams($params);

        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$this->auth));
                
        switch($method) {
            case "POST":
                curl_setopt($c, CURLOPT_POST, 1);
                curl_setopt($c, CURLOPT_POST, count($params));
                curl_setopt($c, CURLOPT_POSTFIELDS, $paramstr);
                curl_setopt($c, CURLOPT_URL, $this->url."/".$command);
                break;
            case "GET":
                curl_setopt($c, CURLOPT_HTTPGET, 1);
                $url = (!empty($paramstr)) ? $this->url."/".$command."?".$paramstr : $this->url."/".$command;
                curl_setopt($c, CURLOPT_URL, $url);
                break;
            default:
                throw new \Exception('Bad method');
                                
        }
        
        
        $curlRet = curl_exec($c);
        $curlErrno = curl_errno($c);
        if ($curlErrno) {
                throw new \Exception('CURL Error '. curl_error($c));
        }
        
        $restResponse = new RestResponse();
        $restResponse->httpCode = curl_getinfo($c, CURLINFO_HTTP_CODE);
        $restResponse->response = $curlRet;

        curl_close($c);
        
        return $restResponse;
    }
    
    private function buildRequestParams($params) {
        $postfields = [];

        foreach ($params as $key => $value) {
            $postfields[] = urlencode($key) . '=' . urlencode($value);
        }
        return join('&' ,$postfields);        
    }
}
