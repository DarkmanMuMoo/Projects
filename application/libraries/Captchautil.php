<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Captchautil {
    //put your code here
    private $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     
    private function ranDomStr($length){

$str_result = ""; //สตริงว่างสำหรับจะรับค่าจากการ random
while(strlen($str_result)<$length){ //วนลูปจนกว่าจะได้สตริงตามความยาวที่ต้องการ
$str_result .= substr($this->pool,(rand()%strlen($this->pool)),1); //ต่อ string จาก substring ที่ได้จากการ random ตำแหน่ง ทีละ 1 ตัว จนกว่าจะครบตรามความยาวที่ส่งมา
}
return($str_result);//ส่งค่ากลับ
}
private function gentpic($str){
   $font="./asset/fonts/CaflischScriptPro-Regular.otf";
    $image = imagecreate(150,40);	//สร้างภาพโดยการกำหนดขนาด ยาว(แกน x), กว้าง(แกน y)
$bg = imagecolorallocate($image,200,220,220); //กำหนดสีพื้น (ภาพ,Red,Green,Blue)

$black = imagecolorallocate($image, 0, 0, 0); //กำหดนค่าสีของสีดำซึ่งจะใช้เป็นสีของตัวอักษร

imagettftext($image,28,0,5,25,$black,$font,$str); //นำตัวอักษรจากฟอร์มมาวาดเป็นรูป (รูปพื้นหลัง,ขนาด,มุม,พิกัด x-coordinate,y-coordinate,สีฟอนต์,ฟอนต์,ข้อความ) ***ระบบ coordinate (x=0,y=0)จะอยู่มุมซ้ายบนสุดนะครับ



return $image;

}


public function captcha(){
    
    $result = array();
    $str=$this->ranDomStr(8);
    $result['word']=$str;
    $result['img']=$this->gentpic($str);
    return  $result;
    
    
    
}



}

/* End of file Someclass.php */