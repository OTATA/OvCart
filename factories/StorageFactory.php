<?php
/**
 * StorageFactory
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */
namespace OvCart\Factories;

use OvCart\Factories\Factory;

class StorageFactory {
    use Factory;
            
    public static function getInterface() {
        return 'OvCart\Storage\ICartStorage';
    }
}
