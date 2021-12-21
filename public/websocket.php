<?php


require "../bootstrap.php";

use Src\Ws\WsGateway;


$ws = WS_URL."/ws/pbx_".PBX_NAME."?pbxkey=".API_KEY;

$client = new WebSocket\Client($ws);
$wsGateway = new WsGateway();
        
while (true) {
    try {
        $data = $client->receive();
        $wsGateway->processData($data);
    } catch (\WebSocket\ConnectionException $e) {
        if($e->getCode() == 1024) {
            
        } else {
            echo "error!! $e\n";
            exit();
        }
    }
}
$client->close();
