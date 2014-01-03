<?php
/**
 * Session Storage
 * 
 * Use the session to storage the datas of cart
 * 
 */

namespace OvCart\Storage;
use OvCart\Storage\ICartStorage;

abstract class SessionStorageAbstract implements ICartStorage {

    private $session;
    private $name;

    public function __construct($name = 'default') {
        $this->session = &$_SESSION;
        $this->name = $name;       
    }

    public function add($name, $value) {
        $this->session[$this->name][$name] = $value;
        return $this;
    }

    public function remove($name) {
        unset($this->session[$this->name][$name]);
        return $this;
    }

    public function getAll() {
        return $this->session[$this->name];
    }

    public function get($key) {
        $data = $this->getAll();
        if(isset($data[$key])) {
            return $data[$key];
        }
        return false;
    }
    
    public function removeAll() {
        $this->session[$this->name] = array();
    }
    
    public function setSessionHandler(\SessionHandlerInterface $sessionHandler) {
        session_set_save_handler($sessionHandler, true);        
    }    
    
    public function setName($name) {
        $this->name = $name;
    }
} 
