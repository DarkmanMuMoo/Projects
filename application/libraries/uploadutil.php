<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploadutil
 *
 * @author Dark
 */
class Uploadutil {
    //put your code here
    
    public function  upload($config,$name='myfile'){
        $CI =&get_instance(); 
           $CI->load->library('upload');
                 $CI->upload->initialize($config);
        
        $message='error';
        if ( ! $CI->upload->do_upload($name))
		{
            $message=$CI->upload->display_errors();
			

			
		}
		else
		{
			$message='complete';
		}
                
                return $message;
    }
    
    
}

?>
