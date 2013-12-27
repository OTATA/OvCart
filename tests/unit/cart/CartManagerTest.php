<?php
/**
 * Description of CartManagerTest
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */


class CartManagerTest extends \PHPUnit_Framework_TestCase {
   
    public function testGetCart() {        
        $cartManager = new \OvCart\CartManager('test');
        $this->assertInstanceOf('OvCart\Cart',$cartManager->cart());        
    }
    
}
