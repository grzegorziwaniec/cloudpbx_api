<?php


namespace Src\Rest;

/**
 * Klasa opisująca odpowiedź interfejsu REST
 *
 * @author grzesiek
 */
class RestResponse {

    public $response;
    public $httpCode;
    
    
    /**
     * 
     * @return stdClass | FALSE
     */
    public function decodeJson() {
        $json_response = json_decode($this->response); 
        return (json_last_error() === JSON_ERROR_NONE) ? $json_response : FALSE;
    }
    
}
