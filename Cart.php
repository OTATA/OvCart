<?php

/**
 * Cart
 * 
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */

namespace OvCart;

use OvCart\Item;
use OvCart\Factories\StorageFactory;

class Cart extends AbstractCart {

    public function __construct($name, ICartStorage $storage = null) {
        
        if(null === $storage) {
            $storage = StorageFactory::get('OvCart\Storage\SessionStorage');
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
