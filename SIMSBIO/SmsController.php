<?php
class SmsController{
   public $message;
   public $phone;
   public $username;
   public $key;
   public  $sender_id;
   public $message_type;
   public $dlr;
    
    public function __construct($phon, $msg){
        $this->url = "https://www.sms.movesms.co.ke/API/";
        $this->username = "iankovin";
        $this->key = "d8LQeda9SpZx2l4TsgNQ2kWn2chGRJHzUa9X683M2dxs2XFe2H";
        $this->sender_id = "SMARTLINK";
        $this->message_type = "5";
        $this->dlr = "0";


        $this->message = $msg;
        $this->phone = $phon;
        // $this->$uid = $uids;
    }
    public function sendMessage(){
        $postData = array(
            'action' => 'compose',
            'username' => $this->username,
            'api_key' => $this->key,
            'sender' => $this->sender_id,
            'to' => $this->phone,
            'message' => $this->message,
            'msgtype' => $this->message_type,
            'dlr' => $this->dlr,
        );
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData

        ));

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($status == 200){
            return true;
        }else{
            return false;
        }

        curl_close($ch);
    }
}
?>
