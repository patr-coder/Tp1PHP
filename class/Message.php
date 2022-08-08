<?php 
require_once 'GuestBook.php';
class message{
    const LIMIT_USERNAME = 3;
    const LIMIT_MESSAGE = 10;
    private  $username;
    private $message;
    private $date ;

    public static function fromJSON(string $json): Message
    {
        $data = json_decode($json, true);
        return new self($data['username'], $data['message'], new DateTime("@". $data['date']));
    }
    public function  __construct(string $username, string $message, ? DateTime $date = null) 
    {
        $this -> username = $username;
        $this -> message = $message;
        $this-> date = $date ?: new DateTime();

    }

    public function isValid(): bool
    {
        // return strlen($this->username) >= 3 && strlen($this->message) >= 10;
        return empty($this->getErrors());

    }

    public function getErrors(): array
    {
        $error = [];
        // if(strlen($this->username ) < 3)
        if(strlen($this->username ) < self:: LIMIT_USERNAME){
            $error['username'] = "your username is very short";

        }
        // if(strlen($this->message) < self:: 10)
        if(strlen($this->message) < self:: LIMIT_MESSAGE){

            $error ['message'] = "your message is too short";
            
        }
        return $error;
    }
    public function toHTML():string
    {
        $username = htmlentities($this->username);
        $this->date->setTimezone(new DateTimeZone('Asia/Tokyo'));
        $date = $this->date->format('Y-m-d a H:i');
        $message = nl2br(htmlentities($this->message));

        return <<<HTML
    <p>
        <strong>{$username}</strong> <em>le {$date}</em><br>
        {$message}
    </p>
HTML;        
    }
    public function toJSON() : string
    {
        
            return json_encode([
            'username' => $this-> username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
            ]);


    }
}

?>