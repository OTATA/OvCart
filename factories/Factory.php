<?php
/**
 * Factory
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */
namespace OvCart\Factories;

trait Factory {
    /**
     * Get a class, that implements interface defined by implementation
     * @param mixed $name
     * @return type
     * @throws Exception
     */
    public static function get($className, $constructorParameters = array()) {
        $reflection = new \ReflectionClass($className);
        $instanceOfClass = $reflection->newInstanceArgs($constructorParameters);
        $interface = self::getInterface();
        if( $instanceOfClass instanceof $interface) {
            return $instanceOfClass;
        }
        throw new \Exception('Class is not same type of interface :(');
    }
    abstract static public function getInterface();
}
