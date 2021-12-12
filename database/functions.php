<?php

include "db.php";

class base_class extends db{
    private $Query;//<----$query
                                //"QUERY" , $Email
    public function Normal_Query($query, $param = null){
        if(is_null($param)){
            $this->Query=$this->con->prepare($query);
            return $this->Query->execute();
        }else{
            $this->Query=$this->con->prepare($query);
            return $this->Query->execute($param);//<-----EXECUTE!
        }
    }    
    
    public function count_rows(){
        return $this->Query->rowCount();
    }
    
    public function tesTs(){
        return "hola tesTs";
    }
    
    public function fetch_all(){
        return $this->Query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function security($data){
        return trim(strip_tags($data));
    }
    
    public function Create_Session($session_name, $session_value){
        $_SESSION["$session_name"] = $session_value;
    }
    
    public function Single_Result(){
        return $this->Query->fetch(PDO::FETCH_OBJ);
    }
    
    public function generateLink(){
        return str_shuffle(substr(md5(time().mt_rand().time()), 0, 25));
    }
    
    public function doEmailExist($email){
        $this->Normal_Query("SELECT user_email FROM users_info WHERE user_email = ?", [$email]);
        if($this->count_rows() != 0){
            return true;
        }else{
            return false;
        }
    }
    
   
    
    public function sendEmail($message){
        // SEND EMAIL
        
        $to_msg = $message;
        $to_email = "example@gmail.com";
        $to_title = "Mansiones Baja - Property submission!";
        //HEADERS
        $headers = "From: example@gmail.com\r\n";
        $headers .= "Reply-To: example@gmail.com\r\n";
        $headers .= "Return-Path: example@gmail.com\r\n";
        
        if(mail($to_email,$to_title,$to_msg,$headers)){
                return true;
            }else{
                return false;
            }
    }
    
    /*
    function sendSMS($number, $msg){
        $num = $number;
        $mess = $msg;
        $test = true;
        
        // Account details
        $apiKey = urlencode('rXJ8lc9RUFM-pqOFh5Zkig2rVL76Ay9rJ87pat8dXH');

        // Message details
                         
        $numbers = array(526644771595);
        $sender = urlencode('Test Admin');
        $message = rawurlencode('This is your message');

        $numbers = implode(',', $numbers);

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message, "test" => $test);

        // Send the POST request with cURL
        $ch = curl_init('https://api.txtlocal.com/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Process your response here
        echo $response;
        
        
        
        
        
    }//END SEND MAIL
    */
    
   
    
    
}




?>