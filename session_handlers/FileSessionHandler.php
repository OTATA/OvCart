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

    public function open($savePath, $name) {

        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, 0777);
        }
        return true;
    }

    public function close() {
        return true;
    }

    public function read($id) {
        return (string) file_get_contents("$this->savePath/sess_$id");
    }

    public function destroy($id) {
        $file = "$this->savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    public function gc($maxlifetime) {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }
        return true;
    }

    public function write($id, $data) {
        return file_put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
    }
}
