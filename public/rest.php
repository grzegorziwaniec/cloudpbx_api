<?php

require "../bootstrap.php";

use Src\Rest\RestGateway;
use Src\Rest\RestResponse;

$gw = new RestGateway(API_URL,API_KEY);
$params = ['datestart'=> '2021-12-20', 'datestop'=>'2021-12-20'];


//pobranie listy rekordów CDR
$cdrList= getCdrList($gw, $params);


//pobranie listy nagrań
$recordList = getRecordList($gw, $params);


//pobranie pierwszego pliku nagrania z listy
if(isset($recordList[0])) {
    
    $uniqueid = $recordList[0]->uniqueid;
    
    $format = $recordList[0]->format;
    $filename = $uniqueid.".".$format;
    
    if( (getRecord($gw, $uniqueid, $filename)) !== false){
        echo "plik ". $filename. " został pobrany\n";        
    } else {
        echo "błąd pobierania pliku ". $filename ."\n";                
    }
    
}




function getCdrList($gw,$params) {

    $ret = NULL;

    try {
        
        $restResponse = $gw->curlRequest("GET", "cdr",$params);
        if($restResponse->httpCode == 200){
            $ret = $restResponse->decodeJson();
        } 
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    return $ret;
}

function getRecordList($gw,$params) {

    $ret = NULL;
    
    try {
        
        $restResponse = $gw->curlRequest("GET", "record", $params);
        if($restResponse->httpCode == 200){
            $ret = $restResponse->decodeJson();
        }
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    return $ret;
    
}


function getRecord($gw, $uniqueid, $filename) {

    $fret = $gw->curlRequest("GET", "record/".$uniqueid);
    return file_put_contents($filename, $fret->response);

}

