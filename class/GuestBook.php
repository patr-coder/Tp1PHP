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
        file_put_contents($this->file,$message->toJSON().  PHP_EOL, FILE_APPEND);
    }
    public function getMessages():array
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL,$content);
        // var_dump($lines);
        $messages = [];
        foreach($lines as $line){
            $data = json_decode($line, true);
            
            // $date = new DateTime("@" . $data['date']);
            // $date->setTimezone(new DateTimezone('Asia/Tokyo'));
            // var_dump($date->format('H:i'));
            // $messages[]= new Message($data['username'], $data['message'], new DateTime("@". $data['date']));

            $messages[]= Message::fromJSON($line);
            
    
            // var_dump($messages);
        }
        return array_reverse($messages);
       
    
}

   


}

?>