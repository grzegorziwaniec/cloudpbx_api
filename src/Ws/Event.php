<?php



namespace Src\Ws;

/**
 * Description of WsEvent
 *
 * @author grzesiek
 */
class Event {
    
    
    public $type;    
    public $data;
    
    
    const EVENT_TYPE_SUBSCRIBER = "subscriber";
    const EVENT_TYPE_EXTSTATUS = "extstatus";
    const EVENT_TYPE_QUEUE = "queue";
    const EVENT_TYPE_QMEMBER = "qmember";
    
    static $EVENT_TYPES = ['subscriber','extstatus','queue','qmember'];
    
    
    public function mapObject($object) {

        foreach (self::$EVENT_TYPES as $e) {
            if (property_exists($object, $e)) {
                $this->type = $e;
                $this->data = $object->$e;
            }
        }
    }


    /**
     * Zwraca numer końcówki, której dotyczy event
     * @return string
     */
    public function getCallerNumberFromPeer() {
        
        if(!$this->data || !property_exists($this->data, "peer")) 
            return NULL;
        
        return substr($this->data->peer, strlen(PBX_NAME) + 1);
    }
    
}
