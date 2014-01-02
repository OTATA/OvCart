<?php

/**
 * Description of CartManagerTest
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */
class CartManagerTest extends \PHPUnit_Framework_TestCase {

    public function testGetCart() {
        $cartMock = $this->getMockBuilder('\OvCart\Cart')->disableOriginalConstructor()->getMock();
        $cartManager = new \OvCart\CartManager('test', $cartMock);
        $this->assertInstanceOf('OvCart\Cart', $cartManager->cart());
    }

    public function testUseFileSesionHandler() {
        $cartMock = $this->getMockBuilder('\OvCart\Cart')->disableOriginalConstructor()->getMock();
        $cartManager = new \OvCart\CartManager('test', $cartMock);
        $cartMock->expects($this->once())->method('setSessionHandler');
        $cartManager->useFileSesionHandler();
    }
}
