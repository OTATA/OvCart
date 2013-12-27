<?php

/**
 * Description of FIleStorage
 *
 *  @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */
namespace OvCart\Storage;
use OvCart\Handlers\FileSessionHandler;

class SessionStorage extends SessionStorageAbstract {
    
    CONST FILE_HANDLER = "FileSessionHandler";
    CONST DEFAULT_HANDLER = "default";
    
    public function __construct($name = 'default', $handler = 'default') {
        
        switch ($handler) {
            case self::FILE_HANDLER:
                parent::setSessionHandler(new FileSessionHandler());
                break;
            default:
                break;
        }        
        parent::__construct($name);
    }
}
