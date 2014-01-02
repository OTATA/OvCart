<?php
/**
 * CartManager
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */
namespace OvCart;

class CartManager {

    private $cart;
    
    public function __construct($name, Cart $cart = null) {
        $this->cart = $cart;

        if (is_null($cart)) {
            $this->cart = new Cart($name);
        }
    }

    /**
     * 
     * @return Cart
     */
    public function cart() {
        return $this->cart;
    }
    
    public function useFileSesionHandler() {
        $this->cart->setSessionHandler(Storage\SessionStorage::FILE_HANDLER);
    }
}
