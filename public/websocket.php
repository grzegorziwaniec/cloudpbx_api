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
        
        die("error ".$e->getMessage());
        
    }
}
$client->close();
