<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of smsutil
 *
 * @author Dark
 */
class smsutil {

    //put your code here
   // private $CI;
    private $url;
    private $username;
    private $password;
    private $debumsg;
    private $sender;

    public function getDebumsg() {
        return $this->debumsg;
    }

    public function __construct() {
       // $this->CI = &get_instance();
        $this->url = "http://www.thaibulksms.com/sms_api.php";
        $this->username = '0804402390';
        $this->password = '670256';
        $this->debumsg = '';
        $this->sender = 'SMS';
    }

    public function getSender() {
        return $this->sender;
    }

    public function sentsms($phonenumber, $text, $sender = 'SMS') {
        $url = $this->url;

        $username = $this->username;
        $password = $this->password;
        $msisdn = $phonenumber;
        $message = $text;
        $ScheduledDelivery = date('ymdhm');
        $SMStype = 'standard';
        $data_string = "username=$username&password=$password&msisdn=$msisdn&message=$message";
        $data_string.="&sender=$sender&ScheduledDelivery=$ScheduledDelivery&force=$SMStype";
   
        $agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        $result = curl_exec($ch);
        curl_close($ch);

        return $this->checkresponse($result);
    }

    private function checkresponse($xml) {
        $result = true;
        $xmlDoc = new DOMDocument();
      //  var_dump($xml);
        $xmlDoc->loadXML($xml);
        $que = $xmlDoc->getElementsByTagName('QUEUE');
      
        if ($que->length == 0) {
            $detail = $xmlDoc->getElementsByTagName('Detail')->item(0)->textContent;
            $this->debumsg = 'cannot send sms because'.$detail;
            error_log($this->debumsg);
            $result = false;
        } else {
            $queue =$que->item(0);
            $msisdn = $queue->getElementsByTagName('Msisdn')->item(0);
            $result = true;
            $this->debumsg='send sms to'.$msisdn->textContent;
            error_log($this->debumsg);
        }
        return $result;
    }

}

?>
