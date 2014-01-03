<?php
/**
 * File 
 * 
 * Save the data in an file
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 * 
 */

namespace OvCart\Handlers;

class FileSessionHandler implements \SessionHandlerInterface {

    private $savePath;
    
    /**
     * Tries to create a directory defined in php config
     * 
     * @param string $savePath
     * @param string $name
     * @return boolean
     */
    public function open($savePath, $name) {

        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, 0777);
        }
        return true;
    }
    /**
     * 
     * @return boolean
     */
    public function close() {
        return true;
    }
    /**
     * Return content of the session id
     * 
     * @param mixed $id
     * @return string
     */
    public function read($id) {
        return (string) file_get_contents("$this->savePath/sess_$id");
    }
    /**
     * Remove the file of sesssion id
     * 
     * @param mixed $id
     * @return boolean
     */
    public function destroy($id) {
        $file = "$this->savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }
    /**
     * 
     * Removes all files expired
     * 
     * @param int $maxlifetime
     * @return boolean
     */
    public function gc($maxlifetime) {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }
        return true;
    }
    /**
     * Write data in file, create with session id (path/sess_1234)
     * 
     * @param mixed $id
     * @param mixed$data
     * @return int|boolean
     */
    public function write($id, $data) {
        return file_put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
    }
}
