<?php

/**
 * Cart
 * 
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */

namespace OvCart;

use OvCart\Item;
use OvCart\Storage\SessionStorage;
use OvCart\Storage\ICartStorage;

class Cart extends AbstractCart {

    public function __construct($name, ICartStorage $storage = null) {
        
        if(null === $storage) {
            $storage = new SessionStorage();
        }
        parent::__construct($name, $storage);
    }
    /**
     * Defines the key
     * 
     * @param \OvCart\Item $item
     * @return string
     */
    public function patternKey(Item $item) {
        return $this->name . '_' . $item->getId();
    }
}
