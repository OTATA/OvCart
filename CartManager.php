<?php
/**
 * CartManager
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */
namespace OvCart;
use OvCart\Factories\CartFactory;

class CartManager {

    private $cart;
    
    public function __construct($name, AbstractCart $cart = null) {
        $this->cart = $cart;

        if (is_null($cart)) {
            $this->cart = CartFactory::get('OvCart\Cart', [$name]);
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
