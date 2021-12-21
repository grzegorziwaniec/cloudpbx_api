<?php

namespace Src\Ws;

use Src\Ws\Event;


/**
 *
 *
 * @author grzesiek
 */
class WsGateway {

    /**
     * 
     * @param string $data
     * @return boolean
     */
    public function processData($data) {
        
        $obj = json_decode($data);
        
        if (json_last_error() !== JSON_ERROR_NONE) 
             return FALSE;
        
        if(! property_exists($obj, 'text'))
            return FALSE;
        
        
        $event = new Event();
        $event->mapObject($obj->text);

        if($event->type == Event::EVENT_TYPE_SUBSCRIBER) {                                               
            if(property_exists($event->data, "connectPeerNumber")) {
                echo "Numer ".self::getCallerNumberFromPeer($event->data->peer). " połączenie z " .$event->data->connectPeerNumber."\n";
            }
        }
        
        if($event->type == Event::EVENT_TYPE_EXTSTATUS) {                       
            echo "Numer ".$event->data->exten. " zmienił stan na " .self::getStateName($event->data->status)."\n";
        }

        if($event->type == Event::EVENT_TYPE_QUEUE) {                                               
            echo "Kolejka " .$event->data->peer.", ilość połączeń oczekujących: ".$event->data->calls."\n";
        }

        if($event->type == Event::EVENT_TYPE_QMEMBER) {        
            echo "Agent ".self::getCallerNumberFromPeer($event->data->peer)." kolejki ".$event->data->queue." ilość odebranych połączeń ".$event->data->m_ct."\n";
        }                                       
     
        return TRUE;
        
    }
    /**
     * mapowanie wartości stanów na nazwy
     * 
     * @param int $state
     * @return string
     */
    public static function getStateName($state) {
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
 
    
    /**
     * Zwraca numer końcówki, której dotyczy event
     * 
     * @param string $peer     
     * @return string
     */
    public static function getCallerNumberFromPeer($peer) {
        return substr($peer, strlen(PBX_NAME) + 1);
    }

}
