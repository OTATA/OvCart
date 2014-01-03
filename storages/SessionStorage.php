<?php
/**
 * Session Storage
 * 
 * Use the session to storage the datas of cart
 * Is used here the global $_SESSION to storage the data
 * and is possible define a session hanlder
 * 
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */

namespace OvCart\Storage;

use OvCart\Storage\ICartStorage;
use OvCart\Handlers\FileSessionHandler;

final class SessionStorage implements ICartStorage {

    private $session;
    private $name;
    private $handler;
    
    CONST FILE_HANDLER = "FileSessionHandler";
    CONST DEFAULT_HANDLER = "default";

    public function __construct($name = 'default') {
        $this->session = &$_SESSION;
        $this->name = $name;       
    }
    /**
     * Add value in the session, with the key defined in constructor
     * 
     * @param string $name
     * @param mixed $value
     * @return \OvCart\Storage\SessionStorage
     */
    public function add($name, $value) {
        $this->session[$this->name][$name] = $value;
        return $this;
    }
    /**
     * Remove a key
     * 
     * @param string $name
     * @return \OvCart\Storage\SessionStorage
     */
    public function remove($name) {
        unset($this->session[$this->name][$name]);
        return $this;
    }
    /**
     * Return all data
     * @return mixed
     */
    public function getAll() {
        return $this->session[$this->name];
    }
    /**
     * Return data by key
     * 
     * @param midex $key
     * @return boolean|mixed
     */
    public function get($key) {
        $data = $this->getAll();
        if(isset($data[$key])) {
            return $data[$key];
        }
        return false;
    }
    /**
     * Set a empty array 
     * 
     */
    public function removeAll() {
        $this->session[$this->name] = array();
    }
    
    /**
     * Set session handler, via instace of SessionHandlerInterface 
     * or by constants defined in the class
     * 
     * @param \OvCart\Storage\SessionHandlerInterface $handler|String
     * 
     */
    public function setSessionHandler($handler) {
        switch ($handler) {
            case self::FILE_HANDLER:
                $handler = new FileSessionHandler();
                session_set_save_handler($handler, true);        
                break;
            case $handler instanceof \SessionHandlerInterface:
                session_set_save_handler($handler, true);
                break;
            default:
                break;
        }
        $this->handler = $handler;
    }
    /**
     * Return handler if setted
     * @return \OvCart\Storage\SessionHandlerInterface
     */
    public function getSessionHandler() {
        return $this->handler;
    }

    /**
     * Set name, used as main key
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
} 
