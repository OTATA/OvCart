<?php
/**
 * CartFactory
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */

namespace OvCart\Factories;

use OvCart\Factories\Factory;

class CartFactory {
    use Factory;
    
    public static function getInterface() {
        return 'OvCart\AbstractCart';
    }
}
