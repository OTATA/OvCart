<?php

/**
 * Description of CartTest
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */
use OvCart\Cart;

class CartDefaultStorageTest extends \PHPUnit_Framework_TestCase {

    private $cart;

    public function setUp() {
        $this->cart = new Cart('Test');
    }

    public function testAddItem() {
        $item = new OvCart\Item;
        $item->seId(100);

        $this->cart->addItem($item);

        $this->assertTrue($this->cart->getItemById(100)->getId() == 100);
    }

    public function testeRemoveItem() {
        $item = new OvCart\Item;
        $item->seId(100);

        $this->cart->addItem($item);

        $this->cart->removeItem($item);

        $this->assertCount(0, $this->cart->getItems());
    }

    public function testGetItems() {

        $item1 = new OvCart\Item();
        $item1->seId(100);

        $item2 = new OvCart\Item();
        $item2->seId(10);

        $this->cart->addItem($item1);
        $this->cart->addItem($item2);

        $this->assertCount(2, $this->cart->getItems());
    }

    public function testEmptyCart() {
        $item1 = new OvCart\Item();
        $item1->seId(100);

        $item2 = new OvCart\Item();
        $item2->seId(10);

        $this->cart->addItem($item1)
                ->addItem($item2);

        $this->cart->emptyCart();

        $this->assertCount(0, $this->cart->getItems());
    }

    public function testGetItem() {
        $item1 = new OvCart\Item();
        $item1->seId(100);

        $this->cart->addItem($item1);

        $this->assertEquals($this->cart->getItemById(100)->getId(), $item1->getId());
    }

    public function testSetSessionHandler() {

        $sessionStorageMock = $this->getMockBuilder('OvCart\Storage\SessionStorage')
                ->disableOriginalConstructor()
                ->getMock();

        $cart = new Cart('Test', $sessionStorageMock);

        $sessionStorageMock->expects($this->once())->method('setSessionHandler');

        $cart->setSessionHandler(\OvCart\Storage\SessionStorage::FILE_HANDLER);
    }

}
