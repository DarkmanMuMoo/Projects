<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tablegen
 *
 * @author Dark
 */
class Tablegen {
    //put your code here
    
       private $CI;
       
       public function __construct() {
             $this->CI =&get_instance(); 
       }

    public function genfromobjarray($arrayofobject,$heading='',$attribute=array()){
        $CI=$this->CI;
        
      
      $CI->load->library('table');
          foreach ($arrayofobject as $index=>$obj){
            
          
            $arrayofobject[$index]= $this->object_to_array($obj);
          
        }
   
           $str='';
          
          foreach($attribute as $index=>$value ){
              $str.=" $index=\"$value\" ";
              
              
          }
         $tableopen="<table $str  >";
        $tmpl = array ( 'table_open'  => $tableopen );

$CI->table->set_template($tmpl);
        $CI->table->set_heading($heading);
        
       echo $CI->table->generate($arrayofobject);
       
    }
    private function object_to_array( $Class){
            # Typecast to (array) automatically converts stdClass -> array.
            $Class = (array)$Class;
            
            # Iterate through the former properties looking for any stdClass properties.
            # Recursively apply (array).
            foreach($Class as $key => $value){
                if(is_object($value)&&get_class($value)==='stdClass'){
                    $Class[$key] = self::object_to_array($value);
                }
            }
            return $Class;
        }
    
    
}

?>
