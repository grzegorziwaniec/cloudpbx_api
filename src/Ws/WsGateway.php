<?php

namespace Src\Ws;

use Src\Ws\Event;


/**
 * Description of WsGateway
 *
 * @author grzesiek
 */
class WsGateway {
    
    public function processData($data) {
        
        $obj = json_decode($data);
        
        if (json_last_error() !== JSON_ERROR_NONE) 
             return FALSE;
        
        if(! property_exists($obj, 'text'))
                return false;
        
        
        $event = new Event();
        $event->mapObject($obj->text);

        if($event->type == Event::EVENT_TYPE_SUBSCRIBER) {                                               
            if(property_exists($event->data, "connectPeerNumber")) {
                echo "Numer ".$event->getCallerNumberFromPeer(). " połączenie z " .$event->data->connectPeerNumber."\n";
            }
        }
        
        if($event->type == Event::EVENT_TYPE_EXTSTATUS) {                       
            echo "Numer ".$event->data->exten. " zmienił stan na " .self::getStateName($event->data->status)."\n";
        }

        if($event->type == Event::EVENT_TYPE_QUEUE) {                                               
            echo "Kolejka " .$event->data->peer.", ilość połączeń oczekujących: ".$event->data->calls."\n";
        }

        if($event->type == Event::EVENT_TYPE_QMEMBER) {        
            echo "Agent ".$event->getCallerNumberFromPeer()." kolejki ".$event->data->queue." ilość odebranych połączeń ".$event->data->m_ct."\n";
        }                                       
        
    }
    
    static function getStateName($state) {
        $arr = [
            0 => "Wolny", //Idle
            1 => "Rozmowa", //In Use
            2 => "Zajęty", //Busy
            4 => "Niedostępny", //Unavailable
            8 => "Dzwoni", //Ringing
            16 => "Zawieszony", //On Hold
            32 => "Łączenie", //
        ];
        return isset($arr[$state]) ? $arr[$state] : "nieznany";
    }
 
    
    
    
}
