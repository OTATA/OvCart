<?php
/**
 * Description of SessionStorageTest
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */

use OvCart\Storage\SessionStorage;

class SessionStorageTest extends \PHPUnit_Framework_TestCase {
    /**
     *
     * @var SessionStorage
     */
    private $sessionStorage;
    
    public function setUp() {
        $this->sessionStorage = new SessionStorage('Test');
    }    
    
    public function testAdd() {      
        $this->sessionStorage->add('teste', '123');        
        $this->assertTrue($this->sessionStorage->get('teste') == 123);
    }
    public function testGetAll() {      
        $this->sessionStorage->add('teste', '123');
        $this->sessionStorage->add('teste2', '23'); 
        $this->sessionStorage->add('teste3', '13'); 
        $this->assertCount(4,$this->sessionStorage->getAll());
    }
    public function testRemove() {
        $this->sessionStorage->remove('teste');
        $this->assertFalse($this->sessionStorage->get('teste'));
    }
    public function testRemoveAll() {
        $this->sessionStorage->removeAll();
        $this->assertCount(0,$this->sessionStorage->getAll());
    }
}
