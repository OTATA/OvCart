<?php
/**
 * 
 * Description of FileSessionHandler
 *
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * @covers OvCart\Handlers\FileSessionHandler
 */
class FileSessionHandlerTest extends \PHPUnit_Framework_TestCase {
       
    private $handler;
    
    public function setUp() {
        $this->handler = new OvCart\Handlers\FileSessionHandler();
    }
    
    /**
     * @covers OvCart\Handlers\FileSessionHandler::open
     */
    public function testOpen() {
        $this->handler->open(__DIR__ ."/sessionTest", 'test');
        $this->assertTrue(is_dir(__DIR__ ."/sessionTest"));
    }
       
    public function testWriteRead() {
        $this->handler->open(__DIR__ ."/sessionTest", 'test');
        $this->handler->write(1, 'test');
        $this->assertEquals('test',$this->handler->read(1));
    }
    
    public function testGc() {
        $this->handler->open(__DIR__ ."/sessionTest", 'test');
        $this->handler->write(1, 'test');
        sleep(1);
        $this->handler->gc(0.1);
        $this->assertFalse(file_exists((__DIR__ ."/sessionTest/sess_1")));
    }
    
    public function testDestroy() {
        $this->handler->open(__DIR__ ."/sessionTest", 'test');
        $this->handler->write(1, 'test');
        $this->handler->destroy(1);
        $this->assertFalse(file_exists((__DIR__ ."/sessionTest/sess_1")));
    }    
}
