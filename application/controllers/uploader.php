<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploader
 *
 * @author Dark
 */
class Uploader  extends CI_Controller  {
    //put your code here
    
    
        public function  testDirectory(){
      $this->load->helper('directory');
      $map = directory_map('./uploads');
      echo var_dump(is_dir('./uploads'));
        echo var_dump($map);
        
    }
    public function  do_upload(){
        $config=array();
        $config['upload_path'] = './uploads';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '51200';
		

		$this->load->library('upload');
                 $this->upload->initialize($config);
$message='';
        if ( ! $this->upload->do_upload('myfile'))
		{
            $message=$this->upload->display_errors();
			

			
		}
		else
		{
			$message='complete';
		}
                
                echo $message;
       
    }
}

?>
