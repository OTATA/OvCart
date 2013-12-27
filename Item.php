<?php
/**
 * Simple Item class
 * 
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */

namespace OvCart;

class Item {

    private $id;
    private $name;
    
    public function seId($id) {
        $this->id = (int) $id;
    }

    public function getId() {
        return $this->id;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}