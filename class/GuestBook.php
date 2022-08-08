<?php 
require_once 'Message.php';

class GuestBook{
    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
        $directory = dirname($file);
        if(!is_dir($directory)){
            mkdir($directory, 0777,true);
        }
        if(!file_exists($file)){
            touch($file);
        }
    }
    public function addMessage(message $message):void
    {
        file_put_contents($this->file,$message->toJSON(). PHP_EOL, FILE_APPEND);
    }

}

?>