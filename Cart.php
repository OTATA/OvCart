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
use Storage\ICartStorage;

class Cart {

    private $name;
    private $storage;

    public function __construct($name, ICartStorage $storage = null) {
        $this->name = $name;
        $this->storage = $storage;

        if (is_null($storage)) {
            $this->storage = new SessionStorage();
        }
        $this->storage->setName($this->name);
    }
    /**
     * Add item on the cart
     * 
     * @param \OvCart\Item $item
     * @return \OvCart\Cart
     */
    public function addItem(Item $item) {
        $this->storage->add($this->patternKey($item), serialize($item));
        return $this;
    }
    /**
     * Defines the key
     * 
     * @param \OvCart\Item $item
     * @return string
     */
    private function patternKey(Item $item) {
        return $this->name . '_' . $item->getId();
    }
    /**
     * Remove item
     * 
     * @param \OvCart\Item $item
     * @return \OvCart\Cart
     */
    public function removeItem(Item $item) {
        $this->storage->remove($this->patternKey($item));
        return $this;
    }
    /**
     * Return all items 
     * 
     * @return array
     */
    public function getItems() {
        $items = $this->storage->getAll();
        foreach ($items as $index => $itemSerialized) {
            $items[$index] = unserialize($itemSerialized);
        }
        return $items;
    }
    /**
     * Return one item by id
     * 
     * @param int $id
     * @return Item
     * 
     */
    public function getItemById($id) {
        return unserialize($this->storage->get($this->name . '_' . $id));
    }
    /**
     * Empty the cart 
     * @return void
     * 
     */
    public function emptyCart() {
        $this->storage->removeAll();
    }
    /**
     * Set session handler in the storage
     * 
     * @param \OvCart\Storage\SessionHandlerInterface $handler|String
     */
    public function setSessionHandler($handler) {
        $this->storage->setSessionHandler($handler);
    }

}
