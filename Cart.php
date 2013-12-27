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

class Cart {

    private $name;
    private $storage;

    public function __construct($name, SessionStorage $storage = null) {
        $this->name = $name;
        $this->storage = $storage;

        if (is_null($storage)) {
            $this->storage = new SessionStorage();
        }
        $this->storage->setName($this->name);
    }
    
    public function addItem(Item $item) {
        $this->storage->add($this->patternKey($item), serialize($item));
        return $this;
    }

    private function patternKey(Item $item) {
        return $this->name . '_' . $item->getId();
    }

    public function removeItem(Item $item) {
        $this->storage->remove($this->patternKey($item));
        return $this;
    }

    public function getItems() {
        $items = $this->storage->getAll();
        foreach ($items as $index => $itemSerialized) {
            $items[$index] = unserialize($itemSerialized);
        }
        return $items;
    }

    public function getItemById($id) {
        return unserialize($this->storage->get($this->name . '_' . $id));
    }
    
    public function emptyCart() {
        $this->storage->removeAll();
    }
}
